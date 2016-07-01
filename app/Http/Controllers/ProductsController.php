<?php

namespace App\Http\Controllers;

use App\Proveedores;
use App\Categorias;
use App\Products;
use Excel;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Products::All();

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

        if ($file_contents) {
            $data = array();
            $total_count = $file_contents->count();
            foreach($file_contents as $row)
            {
                $proveedorObj = Proveedores::getOrCreateProveedorByName($row[1]);
                $categoriaObj = Categorias::getOrCreateCategoriaByName($row[2]);

                $data['proveedor_id']           = $proveedorObj ? $proveedorObj->id : null;
                $data['categoria_id']           = $categoriaObj ? $categoriaObj->id : null;
                $data['nombre_producto']        = $row[3];
                $data['ingrediente_activo']     = $row[4];
                $data['formulacion']            = $row[5];
                $data['concentracion']          = $row[6];
                $data['presentacion']           = $row[7];
                $data['unidad']                 = $row[8];
                $data['empaque']                = $row[9];
                $data['precio_comercial']       = $row[10];
                $data['precio_por_medida']      = $row[11];
                $data['ultima_actualizacion']   = $row[12];

                try {
                    $newProduct = Products::firstOrCreate($data);
                    ($newProduct->wasRecentlyCreated == 1) ? $new_products_count++ : $exists_count++;
                }
                catch (\Exception $e) {
                    $products_error[] = ['nombre_producto_error' => $row[3], 'id_fila_error' => $row[0],
                        'error_msg' => $e->getMessage()];
                    $error_count++;
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
        return view('products.search');
    }

}
