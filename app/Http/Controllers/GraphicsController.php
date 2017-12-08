<?php

namespace App\Http\Controllers;

use App\Proveedores;
use App\Products;
use App\Analysis_category_price;
use App\Analysis_prices_product;
use Carbon\Carbon;
use Log;

use Illuminate\Http\Request;

use App\Http\Requests;

class GraphicsController extends Controller
{

	public function updateAnalysisPrice($category_id, $analisis_especifico, $tipo_analisis, $producto_ingrediente, $compania, $tiempo){

    	$producto_ingrediente_analisis = $tipo_analisis == "producto" ? 'nombre_producto' : 'ingrediente_activo';
    	$proveedor = $compania == "todas" ? '%' : $compania;
    	$fechas_productos = Analysis_category_price::with(['analysis_prices_products' => function($query) use ($producto_ingrediente, $producto_ingrediente_analisis, $proveedor){
    		$query->where($producto_ingrediente_analisis, '=', $producto_ingrediente)
		    	  ->where('proveedor_id', 'like', $proveedor);
    	}])->orderBy('date_list', 'desc')->get();

		$fechas = [];
		$valor = [];

		/******* $tiempo ********/
		/* 	0 = Ultimas 10 actualizaciones
			1 = Todos los años
		*/

		/******* $analisis_especifico **********/
    	/* 	0 = promedio general
			1 = precio minimo registrado
			2 = precio maximo registrado
			3 = quartiles
			4 = media
			5 = mediana
			6 = analisis comparativo PE/PE
			7 = analisis comparativo PE/IA
		*/
		if($tiempo == 0){
			$cont = 0;
			foreach ($fechas_productos as $fechas_producto) {
				if(!$fechas_producto->analysis_prices_products->isEmpty()){
					$precio_array = [];
					$precio_final = 0;
					foreach ($fechas_producto->analysis_prices_products as $value) {
						array_push($precio_array, $value->precio_por_medida);
					}
					if($analisis_especifico == 0) $precio_final = round(array_sum($precio_array)/count($precio_array), 2);
					elseif($analisis_especifico == 1) $precio_final = min($precio_array);
					else $precio_final = max($precio_array);
					array_unshift($fechas, $fechas_producto->date_list);
					array_unshift($valor,  $precio_final);
					$cont++;
				}
				if($cont == 10) break;
			}
		}else{
			//set up the array for data with dates -> out data_array = ['2009' => [], '2010' => []...'2017' => []]
			$current_time = Carbon::now();
			$año_inicial = Carbon::create(2009, 1, 1, 0, 0, 0);
			$diff_años = $año_inicial->diffInYears($current_time, false);
			$init_year = 2009;
			$data_array = [];
			for ($i=0; $i < $diff_años + 1; $i++) { 
				$data_array[$init_year] = [];
				$init_year++;
			}
			
			//fill the array with the corresponded prices
			foreach ($fechas_productos as $fechas_producto) {
				$year = substr($fechas_producto->date_list, 0, 4);
				if(!$fechas_producto->analysis_prices_products->isEmpty()){
					foreach ($fechas_producto->analysis_prices_products as $value) {
						array_push($data_array[$year], $value->precio_por_medida);
					}
				}
			}

			//clean the array
			foreach ($data_array as $key => $data) {
				if($data == []) unset($data_array[$key]);
				else {
					switch ($analisis_especifico) {
						case 0:
							$data_array[$key] = round(array_sum($data)/count($data), 2);
							break;
						case 1:
							$data_array[$key] = min($data);
							break;
						case 2:
							$data_array[$key] = max($data);
							break;
						default:
							$data_array[$key] = max($data);
							break;
					}
					
				}
			}

			$fechas = array_keys($data_array);
			$valor = array_values($data_array);
		}

		array_push($fechas, '');
        return response()->json(array('dates' => $fechas, 'values' => $valor));
    }

    public function getProducts($category_name, $company_id){
    	$proveedor = $company_id == "todas" ? '%' : $company_id;
    	if($category_name == "Otros"){
    		$product_name = Analysis_prices_product::whereNotIn('tipo_producto', ['herbicida', 'insecticida', 'fungicida'])
    												->where('proveedor_id', 'like', $proveedor)
    												->orderBy('nombre_producto', 'asc')->pluck('nombre_producto')->unique()->values()->all();
    		$ingredient_name = Analysis_prices_product::whereNotIn('tipo_producto', ['herbicida', 'insecticida', 'fungicida'])
    												->where('proveedor_id', 'like', $proveedor)
			    									->where('ingrediente_activo', '!=', '-')
			    									->orderBy('ingrediente_activo', 'asc')->pluck('ingrediente_activo')->unique()->values()->all();
    	}else{
    		$product_name = Analysis_prices_product::where('tipo_producto', $category_name)
    												->where('proveedor_id', 'like', $proveedor)
    												->orderBy('nombre_producto', 'asc')->pluck('nombre_producto')->unique()->values()->all();
    		$ingredient_name = Analysis_prices_product::where('tipo_producto', $category_name)
    												->where('proveedor_id', 'like', $proveedor)
			    									->where('ingrediente_activo', '!=', '-')
			    									->orderBy('ingrediente_activo', 'asc')->pluck('ingrediente_activo')->unique()->values()->all();
			    	}
    	return response()->json(array('products' => $product_name, 'ingredients' => $ingredient_name));
    }
}
