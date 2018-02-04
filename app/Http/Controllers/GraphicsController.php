<?php

namespace App\Http\Controllers;

use App\Proveedores;
use App\Products;
use App\Analysis_category_price;
use App\Analysis_prices_product;
use App\Analysis_import_list;
use App\Analysis_import_ingredient;
use Carbon\Carbon;
use Log;

use Illuminate\Http\Request;

use App\Http\Requests;

class GraphicsController extends Controller
{

	public function updateAnalysisPrice($category_id, $analisis_especifico, $tipo_analisis, $producto_ingrediente, $compania, $tiempo, $producto_ingrediente2, $compania2){

    	/******* $tiempo ********/
		/* 	0 = Ultimas 10 actualizaciones
			1 = Todos los años
		*/

		/******* $analisis_especifico **********/
    	/* 	0 = promedio general
			1 = precio minimo registrado
			2 = precio maximo registrado
			3 = quartiles
			4 = mediana
			5 = analisis comparativo PE/PE
			6 = analisis comparativo PE/IA
		*/

    	$fechas_productos = Analysis_category_price::getDatesAndProducts($producto_ingrediente, $tipo_analisis, $compania);
    	$fechas_productos_2 = [];

    	if($analisis_especifico == 5){
	    	$fechas_productos_2 = Analysis_category_price::getDatesAndProducts($producto_ingrediente2, "producto", $compania2);
    	}

    	if($analisis_especifico == 6){
	    	$fechas_productos_2 = Analysis_category_price::getDatesAndProducts($producto_ingrediente2, "ingrediente", $compania2);
    	}

		if($tiempo == 0) {
			$first_graphic = $this->lastUpdates($fechas_productos, $analisis_especifico);
			$second_graphic = $this->lastUpdates($fechas_productos_2, $analisis_especifico);
			$data = $this->fixDataLastUpdates($first_graphic, $second_graphic);
		}
		else{
			$data = [];
			$data_array = $this->allYears($fechas_productos);
			$data_array2 = $this->allYears($fechas_productos_2);
			$all_data = $this->fixAllYears($data_array, $data_array2, $analisis_especifico);
			$data[0] = array_keys($all_data[0]);
			$data[1] = array_values($all_data[0]);
			$data[2] = array_values($all_data[1]);
		}
		array_push($data[0], '');
        return response()->json(array('dates' => $data[0], 'values' => $data[1], 'values2' => $data[2]));
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

    private function lastUpdates($fechas_productos, $analisis_especifico){
    	$cont = 0;
    	$fechas = [];
    	$valor = [];
		foreach ($fechas_productos as $fechas_producto) {
			if(!$fechas_producto->analysis_prices_products->isEmpty()){
				$precio_array = [];
				$precio_final = 0;
				foreach ($fechas_producto->analysis_prices_products as $value) {
					array_push($precio_array, $value->precio_por_medida);
				}
				if($analisis_especifico == 0 || $analisis_especifico == 5 || $analisis_especifico == 6) $precio_final = round(array_sum($precio_array)/count($precio_array), 2);
				elseif($analisis_especifico == 1) $precio_final = min($precio_array);
				elseif($analisis_especifico == 2) $precio_final = max($precio_array);
				elseif($analisis_especifico == 3){
					$precio_final = [0,1,2,3];
				}
				else{
					sort($precio_array);
					if(count($precio_array) == 1) $precio_final = $precio_array[0];
					else {
						if(!(count($precio_array) % 2)){
							$precio_final = ($precio_array[count($precio_array)/2] + $precio_array[(count($precio_array)/2)-1])/2;
						}else $precio_final = $precio_array[floor(count($precio_array)/2)];
					}
				}			
				array_push($valor,  $precio_final);
				$cont++;
			}else array_push($valor,  'NaN');
			array_push($fechas, date('m-d-Y', strtotime($fechas_producto->date_list)));
			if($cont == 10) break;
			
		}
		return(array($fechas, $valor));
    }

    private function fixDataLastUpdates($first_graphic, $second_graphic){
    	$fechas = [];
    	$valor1 = [];
    	$valor2 = [];
    	$cont = 0;
    	foreach ($first_graphic[0] as $key => $value) {
    		if($first_graphic[1][$key] != 'NaN') {
    			$cont++;
    			array_push($fechas, $value);
    			array_push($valor1, $first_graphic[1][$key]);
    			if($second_graphic[0] != [] && $second_graphic[1][$key] != 'NaN') array_push($valor2, $second_graphic[1][$key]);
    			else array_push($valor2, 'NaN');
    		}else{
    			if($second_graphic[0] != [] && $second_graphic[1][$key] != 'NaN'){
    				$cont++;
    				array_push($fechas, $value);
    				array_push($valor2, $second_graphic[1][$key]);
    				array_push($valor1, 'NaN');
    			}
    		}
    		if($cont == 10) break;
    	}
    	$fechas = array_reverse($fechas);
    	$valor1 = array_reverse($valor1);
    	$valor2 = array_reverse($valor2);
    	return array($fechas, $valor1, $valor2);
    }

    private function allYears($fechas_productos){
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
		foreach ($fechas_productos as $key => $fechas_producto) {
			$year = substr($fechas_producto->date_list, 0, 4);
			if(!$fechas_producto->analysis_prices_products->isEmpty()){
				foreach ($fechas_producto->analysis_prices_products as $value) {
					array_push($data_array[$year], $value->precio_por_medida);
				}
			}
		}

		return $data_array;
    }

    private function fixAllYears($data_array, $data_array2, $analisis_especifico){
    	//clean the array
		foreach ($data_array as $key => $data) {
			if($data == [] && $data_array2[$key] == []) {
				unset($data_array[$key]);
				unset($data_array2[$key]);
			}
			elseif($data != []){
				$data_array = $this->swicthForfix($analisis_especifico, $data_array, $key);
				if($data_array2[$key] != []) $data_array2 = $this->swicthForfix($analisis_especifico, $data_array2, $key);
				else $data_array2[$key] = 'NaN';
			}
			else {
				if($data_array2[$key] != []){
					$data_array2 = $this->swicthForfix($analisis_especifico, $data_array2, $key);
					$data_array[$key] = 'NaN';	
				}
			}
		}
		return array($data_array, $data_array2);
    }

    private function swicthForfix($analisis_especifico, $data_array, $key){
    	switch ($analisis_especifico) {
			case [0, 5, 6]:
				$data_array[$key] = round(array_sum($data_array[$key])/count($data_array[$key]), 2);
				break;
			case 1:
				$data_array[$key] = min($data_array[$key]);
				break;
			case 2:
				$data_array[$key] = max($data_array[$key]);
				break;
			case 4:
				sort($data_array[$key]);
				if(count($data_array[$key]) != 1){
					if(!(count($data_array[$key]) % 2)){
						$data_array[$key] = ($data_array[$key][count($data_array[$key])/2] + $data_array[$key][(count($data_array[$key])/2)-1])/2;
					}else $data_array[$key] = $data_array[$key][floor(count($data_array[$key])/2)];
				}
				break;
			default:
				$data_array[$key] = round(array_sum($data_array[$key])/count($data_array[$key]), 2);
				break;
		} 
		return $data_array;
    }

    public function updateAnalysisHistoric($ingrediente_id, $year){
    	$ingredient_data = Analysis_import_list::where(['analysis_import_ingredient_id' => $ingrediente_id, 'year' => $year])->get();
    	
    	$volumen_total = 0;
    	$precio_total = 0;
    	$volumen_mes = [];
    	$array_precio_prom = [];

    	foreach ($ingredient_data as $key => $row) {
    		if($row->amount != 0.00) array_push($volumen_mes, round($row->amount/1000, 2));
    		$volumen_total = $volumen_total + $row->amount;

    		if($row->price != 0.00) array_push($array_precio_prom, $row->price);
    		$precio_total = $precio_total + $row->price;
    	}

    	$precio_total_prom = $precio_total != 0 ? round($precio_total/count($array_precio_prom), 2) : 0;
    	$volumen_total = $volumen_total != 0 ? round($volumen_total/1000, 2) : 0;

    	return response()->json(array('volumen_mes' => $volumen_mes, 'volumen_total' => $volumen_total, 'precio_prom_mes' => $array_precio_prom, 'precio_total_prom' => $precio_total_prom, 'trimestres' => count($array_precio_prom)));
    }

    public function getIngredientes($categoria_id){
    	$ingredient_data = Analysis_import_ingredient::where('categoria_id', $categoria_id)->orderBy('ingrediente_activo', 'asc')->pluck('ingrediente_activo', 'id')->all();
    	return response()->json(array('ingredientes' => $ingredient_data));
    }

    public function getYears($ingrediente_id){
    	$years = Analysis_import_list::where('analysis_import_ingredient_id', $ingrediente_id)->orderBy('year', 'asc')->pluck('year')->unique()->values()->all();
    	return response()->json(array('years' => $years));
    }
}
