<?php

namespace App\Http\Controllers;

use App\Proveedores;
use App\Categorias;
use App\Products;
use App\Analysis_category_image;
use App\Analysis_category_price;
use App\Analysis_prices_product;
use App\Analysis_import_list;
use App\Analysis_import_ingredient;
use Gate;
use Excel;
use Carbon\Carbon;
use DB;
use PDO;
use Validator;
use Schema;
use Log;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->all())
        {
            $search_data = array();
            $products = new Products();

            if ($request->has('nombre_producto'))
            {
                $search_data['nombre_producto'] = $request->get('nombre_producto');
            }
            if ($request->has('ingrediente_activo'))
            {
                $search_data['ingrediente_activo'] = $request->get('ingrediente_activo');
            }
            if ($request->has('nombre_empresa'))
            {
                $search_data['proveedor_id'] = Proveedores::getProveedorArrayByName($request->get('nombre_empresa'));
            }
            if ($request->has('presentacion'))
            {
                $search_data['presentacion'] = $request->get('presentacion');
            }
            if($request->has('categoria'))
            {
                $search_data['categoria_id'] = $request->get('categoria');;
            }
            $products = Products::searchByFields($search_data);
        }
        else{
            $products = Products::All();
        }

        return view('products.index')->withProducts($products);
    }

    public function import()
    {
        return view('products.import');
    }

    public function processImport()
    {
        $products_error = array();
        $new_products_count = 0;
        $error_count = 0;
        $exists_count = 0;
        $total_count = 0;
        try {
            $file_contents = Excel::load(Input::file('input-1'))->noHeading()->get();
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return redirect(route('products.index'));
        }
        set_time_limit(600);
        if ($file_contents) { 
            try {
                $this->exportProductsToCvs(); //backup old products
                $this->exportProductsToNewTable(); //backup old products
                DB::table('products')->delete(); // delete old products
            } catch (Exception $e) {
                return back()->with('warning','Ocurrio un error, por favor intente de nuevo');
            }

            $data = array();
            $total_count = $file_contents->count();
            foreach($file_contents as $row)
            {
                $proveedorObj = (!is_null($row[1])) ? Proveedores::getOrCreateProveedorByName($row[1]) : null;
                $categoriaObj = (!is_null($row[2])) ? Categorias::getOrCreateCategoriaByName($row[2]): null;

                $data['proveedor_id']           = $proveedorObj ? $proveedorObj->id : null;
                $data['categoria_id']           = $categoriaObj ? $categoriaObj->id : null;
                $data['nombre_producto']        = $row[3]  == "" ? '-' : $row[3];
                $data['tipo_producto']          = $row[2]  == "" ? '-' : $row[2];
                $data['ingrediente_activo']     = $row[4]  == "" ? '-' : $row[4];
                $data['formulacion']            = $row[5]  == "" ? '-' : $row[5];
                $data['concentracion']          = $row[6]  == "" ? '0%': $row[6];
                $data['presentacion']           = $row[7]  == "" ? '-' : $row[7];
                $data['unidad']                 = $row[8]  == "" ? '-' : $row[8];
                $data['empaque']                = $row[9]  == "" ? '-' : $row[9];
                $data['precio_comercial']       = $row[10] == "" ?  0  : $row[10];
                $data['precio_por_medida']      = $row[11] == "" ?  0  : $row[11];
                $data['impuesto']               = $row[12] == "" ? '0%': $row[12];
                $data['ultima_actualizacion']   = $this->convertToDate($row[13]);
                try {
                    $newProduct = Products::firstOrCreate($data);
                    ($newProduct->wasRecentlyCreated == 1) ? $new_products_count++ : $exists_count++;
                }
                catch (\Exception $e) {
                    $products_error[] = ['nombre_producto_error' => $row[3], 'id_fila_error' => $row[0],
                        'error_msg' => $e->getMessage()];
                    $error_count++;
                    //dd($row[2] . "----" . $row[1] . "-----" . $row[3]);
                }
            }
        }
        \Session::Flash('success', 'Archivo importado correctamente.');

        return view('products.postimport',
            ['total_count'=> $total_count,
                'exists_count' => $exists_count,
                'new_products_count' => $new_products_count,
                'products_error' => $products_error,
                'error_count' => $error_count]);
    }

    public function searchProducts()
    {
        #$categorias = Categorias::getCategoriasByName(['herbicida', 'fungicida', 'Insecticida']);
        #return view('products.search')->with('categorias', $categorias);

        return view('products.search');
    }

    public function productInfo($data)
    {
        $info = Products::getIndividualInfo($data);
        return response()->json(['response' => $info]);
    }

    public function searchCategories()
    {
        return view('products.categories');
    }

    public function analisisProducts($analisis)
    {
        switch ($analisis) {
            case 'insecticidas':
                $categoria = Categorias::where('nombre_categoria', 'Insecticida')->first();
                break;
            case 'herbicidas':
                $categoria = Categorias::where('nombre_categoria', 'Herbicida')->first();
                break;
            case 'fungicidas':
                $categoria = Categorias::where('nombre_categoria', 'Fungicida')->first();
                break;
            default:
                $categoria = Categorias::where('nombre_categoria', 'Insecticida')->first();
        }
        $category_images = Analysis_category_image::where('categoria_id', $categoria['id'])->get();
        return view('products.analisis')->with('category_images', $category_images);
    }

    public function exportProductsToCvs(){
        $current_time = Carbon::now();
        $name = 'backup_products_'.$current_time->year .'_'. $current_time->month .'_'. $current_time->day .'_'. $current_time->hour .'_'. $current_time->minute .'_'. $current_time->second;
        
        DB::setFetchMode(PDO::FETCH_ASSOC); //to return an array in the DB::query
        $current_products = DB::table('products')
                                ->join('proveedores', 'products.proveedor_id', '=', 'proveedores.id')
                                ->select(['products.id', 'proveedores.nombre_proveedor', 'products.tipo_producto', 'products.nombre_producto', 'products.ingrediente_activo', 'products.formulacion', 'products.concentracion', 'products.presentacion', 'products.unidad', 'products.empaque', 'products.precio_comercial', 'products.precio_por_medida', 'products.impuesto', 'products.ultima_actualizacion', 'created_at', 'updated_at'])
                                ->get();
        DB::setFetchMode(PDO::FETCH_CLASS);

        if($current_products != []){
            Excel::create($name, function($excel) use($current_products) {
                $excel->sheet('first', function($sheet) use($current_products){
                    $sheet->fromArray($current_products);
                });
            })->store('csv', storage_path('app/products_backup'));
        }
    }

    public function exportProductsToNewTable(){
        $current_time = Carbon::now();
        $table_name = 'backup_products_'.$current_time->year .'_'. $current_time->month .'_'. $current_time->day .'_'. $current_time->hour .'_'. $current_time->minute .'_'. $current_time->second;
        Schema::connection('mysql')->create($table_name, function($table) {
            $table->increments('id');
            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->string('nombre_producto');
            $table->string('tipo_producto');
            $table->string('ingrediente_activo');
            $table->string('formulacion');
            $table->string('concentracion');
            $table->string('presentacion');
            $table->string('unidad');
            $table->string('empaque');
            $table->string('precio_comercial');
            $table->string('precio_por_medida');
            $table->string('impuesto');
            $table->date('ultima_actualizacion');
            $table->timestamps();
        });

        DB::insert('INSERT into '.$table_name.' SELECT * FROM products');
    }

    public function convertToDate($dateString){
        if(!$dateString || $dateString == "ultima_actualizacion") return;
        if(preg_match('/[0-9]{4}+[-]+[0-9]{2}+[-][0-9]{2}/', $dateString)) return $dateString;
        try {
            $arr = explode('/', $dateString);
            if(strlen($arr[2]) == 2) $arr[2] = "20".$arr[2];
            $dateInTime = strtotime($arr[0].'-'.$arr[1].'-'.$arr[2]);
            return date('Y-m-d', $dateInTime);
        } catch (Exception $e) {
            return '0000-00-00';
        }
    }

    public function updateProducts(Request $request){
        //Custom validation messages in resources/lang/en 
        $validator = Validator::make($request->all(), [
            'data.*.name' => 'required',
            'data.*.ingredents' => 'required',
            'data.*.priceUni' => 'required',
            'data.*.priceMed' => 'required',
        ]);

        $data = ['nameError' => 0, 'ingError' => 0, 'priceError' => 0];

        //Error messages are set in the main.js file
        if($validator->fails()){
            foreach ($validator->errors()->all() as $error) {
                if($error == 'nameMissing') $data['nameError'] = 1;
                else if($error == 'ingMissing') $data['ingError'] = 1;
                else $data['priceError'] = 1;
            }
            return response()->json(['response' => $data, 'error' => 1]);
        }else{
            //Updating the products values in the DB
            foreach ($request['data'] as $id => $row) {
                $name = strtoupper($row['name']);
                $ingredents = ucfirst($row['ingredents']);

                //remove de comma and $ sign and convert to float
                $price_commercial_converted = (float)substr(str_replace(',', '', $row['priceUni']), 1);
                $price_med_converted = (float)substr(str_replace(',', '', $row['priceMed']), 1);

                //set the number of decimals
                $decimals_commercial = strlen(substr(strrchr($price_commercial_converted, '.'), 1));
                $decimals_commercial = $decimals_commercial > 2 ? $decimals_commercial : 2;

                $decimals_med = strlen(substr(strrchr($price_med_converted, '.'), 1));
                $decimals_med = $decimals_med > 2 ? $decimals_med : 2;

                //add the decimal point and comma
                $price_commercial = number_format($price_commercial_converted, $decimals_commercial, '.', ',');
                $price_med = number_format($price_med_converted, $decimals_med, '.', ',');

                Products::where('id', $id)->update([
                    'nombre_producto' => $name,
                    'ingrediente_activo' => $ingredents,
                    'precio_comercial' => '$'.$price_commercial,
                    'precio_por_medida' => '$'.$price_med,
                ]);
            }
            return response()->json(['response' => 'Actualizacion completada', 'error' => 0]);  
        }
    }

    public function analisisPrecios(){
        $product_name = Analysis_prices_product::where('tipo_producto', 'Insecticida')
                                                ->orderBy('nombre_producto', 'asc')->pluck('nombre_producto', 'nombre_producto')->all();
        $ingredient_name = Analysis_prices_product::where('tipo_producto', 'Insecticida')
                                                ->where('ingrediente_activo', '!=', '-')
                                                ->orderBy('ingrediente_activo', 'asc')->pluck('ingrediente_activo', 'ingrediente_activo')->all();
        $proveedores = Proveedores::orderBy('nombre_proveedor', 'asc')->pluck('nombre_proveedor', 'id')->all();

        $product_name = array('empty' => '') + $product_name;
        $ingredient_name = array('empty' => '') + $ingredient_name;
        $proveedores_name = array('todas' => 'Todas') + $proveedores;
        return view('products.analisisPrecios', ['ingredientes' => $ingredient_name, 'products' => $product_name, 'proveedores_name' => $proveedores_name]);
    }

    public function importProductsAnalysisCategory()
    {
        return view('products.importProductsAnalysisCategory');
    }

    public function processImportProductsAnalysisCategory(Request $request){
        $products_error = array();
        $new_products_count = 0;
        $error_count = 0;
        $exists_count = 0;
        $total_count = 0;
        try {
            $file_contents = Excel::load(Input::file('input-1'))->get();
            $find_acp = Analysis_category_price::where('date_list', $request['fecha_lista'])->first();
            if($find_acp){
                Analysis_category_price::destroy($find_acp->id);
            }
            $new_acp = Analysis_category_price::create(['date_list' => $request['fecha_lista']]);            
        } catch (\Exception $e) {
            \Session::flash('warning', $e->getMessage());
            return redirect(route('import_products_analisys_category'));
        }
        set_time_limit(600);
        if ($file_contents) { 
            $data = array();
            $total_count = $file_contents->count();
            foreach($file_contents as $row)
            {
                $proveedorObj = (!is_null($row[1])) ? Proveedores::getOrCreateProveedorByName($row[1]) : null;
                $categoriaObj = (!is_null($row[2])) ? Categorias::getOrCreateCategoriaByName($row[2]): null;

                $data['proveedor_id']           = $proveedorObj ? $proveedorObj->id : null;
                $data['categoria_id']           = $categoriaObj ? $categoriaObj->id : null;
                $data['nombre_producto']        = ucfirst(strtolower(trim($row[3])));
                $data['tipo_producto']          = trim($row[2]);
                $data['ingrediente_activo']     = $row[4] == "" ? '-' : ucfirst(strtolower(trim($row[4])));
                $data['formulacion']            = $row[5] == "" ? '-' : trim($row[5]);
                $data['concentracion']          = $row[6] == "" ? '0%' : trim($row[6]);
                $data['presentacion']           = $row[7] == "" ? '-' : trim($row[7]);
                $data['unidad']                 = $row[8] == "" ? '-' : trim($row[8]);
                $data['empaque']                = $row[9] == "" ? '-' : trim($row[9]);
                $data['precio_comercial']       = $row[10] == "" ? 0 : $row[10];
                $data['precio_por_medida']      = $row[11] == "" ? 0 : $row[11];
                $data['impuesto']               = $row[12] == "" ? '0%' : $row[12];
                $data['ultima_actualizacion']   = $this->convertToDate($row[13]);
                $data['analysis_category_price_id']   = $new_acp->id;
                try {
                    $newProduct = Analysis_prices_product::firstOrCreate($data);
                    unset($data['analysis_category_price_id']);
                    ($newProduct->wasRecentlyCreated == 1) ? $new_products_count++ : $exists_count++;
                }
                catch (\Exception $e) {
                    $products_error[] = ['nombre_producto_error' => $row[3], 'id_fila_error' => $row[0],
                        'error_msg' => $e->getMessage()];
                    $error_count++;
                    //dd($row[2] . "----" . $row[1] . "-----" . $row[3]);
                }
            }
        }

        \Session::Flash('success', 'Archivo importado correctamente.');

        return view('products.postimport',
            ['total_count'=> $total_count,
                'exists_count' => $exists_count,
                'new_products_count' => $new_products_count,
                'products_error' => $products_error,
                'error_count' => $error_count]);
    }

    public function gestionListasAnalisisPrecios(){
        $listas = Analysis_category_price::orderBy('date_list', 'asc')->get();
        return view('products.gestionListasAnalisisPrecios')->with('listas', $listas);
    }

    public function deleteListCategory($id){
        $lista = Analysis_category_price::where('id', $id)->delete();
        if($lista) return response()->json(['response' => 1]);
        return response()->json(['response' => 0]);       
    }

    public function analisisHistorico(){
        $categorias = Categorias::whereIn('nombre_categoria', ['Insecticida', 'Fungicida', 'Herbicida'])->orderBy('nombre_categoria', 'asc')->get()->pluck('nombre_categoria', 'id');
        $ingredientes = Analysis_import_ingredient::where('categoria_id', $categorias->keys()[0])->orderBy('ingrediente_activo', 'asc')->get()->pluck('ingrediente_activo', 'id');
        $ingredientes->prepend('', 'empty');
        return view('products.analisisHistorico', ['categorias' => $categorias, 'ingredientes' => $ingredientes]);
    }

    public function importAnalysisHistoricLists()
    {
        $categorias = Categorias::whereIn('nombre_categoria', ['Insecticida', 'Fungicida', 'Herbicida'])->orderBy('nombre_categoria', 'asc')->get()->pluck('nombre_categoria', 'id');
        $ingredients = Analysis_import_ingredient::orderBy('ingrediente_activo', 'asc')->get()->pluck('ingrediente_activo', 'id');
        return view('products.importAnalysisHistoricLists', ['ingredients' => $ingredients, 'categorias' => $categorias]);
    }

    public function processImportAnalysisHistoricList(Request $request){
        if($request->has('check_ingrediente')){
            $nuevo_ingrediente = Analysis_import_ingredient::firstOrCreate(['ingrediente_activo' => $request['nombre_ingrediente'], 'categoria_id' => $request['categoria_id']]);
            $ingrediente_id = $nuevo_ingrediente->id;
        }else $ingrediente_id = $request['ingredient_id'];

        try {
            $find_ail = Analysis_import_list::where(['year' => $request['year'], 'analysis_import_ingredient_id' => $ingrediente_id])->first();
            if($find_ail){
                Analysis_import_list::where(['year' => $request['year'], 'analysis_import_ingredient_id' => $ingrediente_id])->delete();
            }          
        } catch (\Exception $e) {
            \Session::flash('warning', 'Ocurrio un error en la carga, intente de nuevo.');
            return redirect(route('import_analysis_historic_lists'));
        }

        $error_count = 0;
        $count = 0;
        $file_contents = Excel::load(Input::file('input-1'))->get();
        set_time_limit(600);
        if ($file_contents) { 
            $data = array();
            $total_count = $file_contents->count();
            for ($i=5; $i < 9; $i++) { 
                $data['analysis_import_ingredient_id']  = $ingrediente_id;
                $data['year']                           = $request['year'];
                $data['trimestre']                      = $file_contents[$i][6] == "" ?  0  : trim($file_contents[$i][6]);
                $data['price']                          = $file_contents[$i][7] == "" ?  0  : trim($file_contents[$i][7]);
                $data['amount']                         = $file_contents[$i][8] == "" ?  0  : trim($file_contents[$i][8]);
                try {
                    $newProduct = Analysis_import_list::firstOrCreate($data);
                    $count++;
                }
                catch (\Exception $e) {
                    $error_count++;
                }
            }
        }

        \Session::Flash('success', 'Registros agregados de forma exitosa.');
        return redirect(route('import_analysis_historic_lists'));
    }

    public function gestionListasAnalisisHistoricos(){
        $listas = Analysis_import_ingredient::orderBy('ingrediente_activo', 'asc')
                                            ->with(['Analysis_import_list' => function($query){
                                                $query->orderBy('year', 'asc');
                                            }])->get();
        $array_ingredientes = [];
        $array_years = [];
        foreach ($listas as $key => $row) {
            $ingrediente = [];
            if(!$row->analysis_import_list->isEmpty()){
                $years = $row->analysis_import_list->pluck('year')->unique()->values()->toArray();
                $ingrediente[$row->id] = $row->ingrediente_activo;
                $array_ingredientes[$key] = [$years, $ingrediente];
            }
        }
        return view('products.gestionListasAnalisisHistoricos')->with('array_ingredientes', $array_ingredientes);
    }

     public function deleteListHistoric($ingrediente_id, $year){
        $lista = Analysis_import_list::where(['analysis_import_ingredient_id' => $ingrediente_id, 'year' => $year])->delete();
        if($lista) return response()->json(['response' => 1]);
        return response()->json(['response' => 0]);       
    }
}
