<?php

namespace App\Http\Controllers;

use App\Proveedores;
use App\Categorias;
use App\Products;
use Gate;
use Excel;
use Carbon\Carbon;
use DB;
use PDO;

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
        $this->exportProductsToCvs(); //backup old products
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
            $data = array();
            $total_count = $file_contents->count();
            foreach($file_contents as $row)
            {
                $proveedorObj = (!is_null($row[1])) ? Proveedores::getOrCreateProveedorByName($row[1]) : null;
                $categoriaObj = (!is_null($row[2])) ? Categorias::getOrCreateCategoriaByName($row[2]): null;

                $data['proveedor_id']           = $proveedorObj ? $proveedorObj->id : null;
                $data['categoria_id']           = $categoriaObj ? $categoriaObj->id : null;
                $data['nombre_producto']        = $row[3];
                $data['tipo_producto']          = $row[2];
                $data['ingrediente_activo']     = $row[4];
                $data['formulacion']            = $row[5];
                $data['concentracion']          = $row[6];
                $data['presentacion']           = $row[7];
                $data['unidad']                 = $row[8];
                $data['empaque']                = $row[9];
                $data['precio_comercial']       = $row[10];
                $data['precio_por_medida']      = $row[11];
                $data['impuesto']               = $row[12];
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
        print_r($analisis);
        switch ($analisis) {
            case 'insecticidas':
                $arr['titulo'] = 'Abamectina';
                $arr['img'] = 'abamectina.jpg';
                print_r($arr);

                break;
            case 'herbicidas':
                $arr['titulo'] = 'Paraquat';
                $arr['img'] = 'paraquat.jpg';
                print_r($arr);
                break;
            case 'fungicidas':
                $arr['titulo'] = 'Azoxystrobin';
                $arr['img'] = 'azoxystrobin.jpg';
                print_r($arr);
                break;
            default:
                $arr = array();
                break;
        }


        return view('products.analisis', ['analisis' => $arr]);
    }

    public function exportProductsToCvs(){
        $current_time = Carbon::now();
        $name = $current_time->year .'-'. $current_time->month .'-'. $current_time->day .' '. $current_time->hour .':'. $current_time->minute .':'. $current_time->second;
        
        DB::setFetchMode(PDO::FETCH_ASSOC); //to return an array in the DB::query
        $current_products = DB::table('products')
                                ->join('proveedores', 'products.proveedor_id', '=', 'proveedores.id')
                                ->select(['products.id', 'proveedores.nombre_proveedor', 'products.tipo_producto', 'products.nombre_producto', 'products.ingrediente_activo', 'products.formulacion', 'products.concentracion', 'products.presentacion', 'products.unidad', 'products.empaque', 'products.precio_comercial', 'products.precio_por_medida', 'products.impuesto', 'products.ultima_actualizacion', 'created_at', 'updated_at'])
                                ->get();
        DB::setFetchMode(PDO::FETCH_ASSOC);

        if($current_products != []){
            Excel::create($name, function($excel) use($current_products) {
                $excel->sheet('first', function($sheet) use($current_products){
                    $sheet->fromArray($current_products);
                });
            })->store('csv', storage_path('app/products_backup'));
        }
    }

    public function convertToDate($dateString){
        if(!$dateString || $dateString == "ultima_actualizacion") return;
        if(preg_match('/[0-9]{4}+[-]+[0-9]{2}+[-][0-9]{2}/', $dateString)) return $dateString;
        try {
            $arr = explode('/', $dateString);
            if(strlen($arr[2]) === 2) $arr[2] = "20".$arr[2];
            $dateInTime = strtotime($arr[0].'-'.$arr[1].'-'.$arr[2]);
            return date('Y-m-d', $dateInTime);
        } catch (Exception $e) {
            return '0000-00-00';
        }
    }

}
