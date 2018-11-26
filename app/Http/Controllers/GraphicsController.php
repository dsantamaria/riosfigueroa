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

	public function updateAnalysisPrice($category_name, $analisis_especifico, $tipo_analisis, $producto_ingrediente, $compania, $tiempo, $producto_ingrediente2, $compania2){

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
			7 = analisis cuartiles
		*/

		if($analisis_especifico == 7){
			$ing_cuartiles = Products::getIngredients($producto_ingrediente, 'ingrediente', $compania);
			$precios = [];
			foreach ($ing_cuartiles as $value) {
				array_push($precios, $value->precio_por_medida);
			}
			$cuartiles = $this->analisisCuartil($ing_cuartiles, $precios, $category_name);
			return response()->json(array('dates' => [], 'values' => [], 'values2' => [], 'cuartiles' => $cuartiles['array_merge'], 'colors' => $cuartiles['colors']));
    	}

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
    	
    	$ingredient_data = Analysis_import_list::where(['analysis_import_ingredient_id' => $ingrediente_id, 'year' => $year])->orderBy('trimestre')->get();
    	/*
    	$provider = [];
    	$volumen_total = 0;
    	$precios = [];

    	$t1 = $ingredient_data[0]['price'];
    	$t2 = $ingredient_data[1]['price'];
    	$t3 = $ingredient_data[2]['price'];
    	$t4 = $ingredient_data[3]['price'];

    	if(!$ingredient_data->isEmpty()) $unit = $ingredient_data[0]->unit == 'kilogramo' ? 'kilogramo' : 'Litro';

    	$provider[0] = $t1 > 0 ? array('value' => $t1, 'label_t1' => '$'.number_format($t1, 2, '.', ''), 'tri' => 'T1', 'color' => '#ffffff') : 
    							 array('value' => 0, 'label_t1' => 'Sin Importaciones Registradas', 'tri' => 'T1', 'color' => '#02881f');

    	$provider[1] = $t2 > 0 ? array('value' => $t1, 'value2' => $t2, 'label_t2' => '$'.number_format($t2, 2, '.', ''), 'tri' => 'T2', 'color' => '#ffffff') : 
    							 array('value2' => 0, 'label_t2' => 'Sin Importaciones Registradas', 'tri' => 'T2', 'color' => '#1c24d8');

    	$provider[2] = $t3 > 0 ? array('value' => $t1, 'value2' => $t2, 'value3' => $t3, 'label_t3' => '$'.number_format($t3, 2, '.', ''), 'tri' => 'T3', 'color' => '#ffffff') : 
    							 array('value3' => 0, 'label_t3' => 'Sin Importaciones Registradas', 'tri' => 'T3', 'color' => '#ff9800');

    	$provider[3] = $t4 > 0 ? array('value' => $t1, 'value2' => $t2, 'value3' => $t3, 'value4' => $t4, 'label_t4' => '$'.number_format($t4, 2, '.', ''), 'tri' => 'T4', 'color' => '#ffffff') : 
    							 array('value4' => 0, 'label_t4' => 'Sin Importaciones Registradas', 'tri' => 'T4','color' => '#fb1818');

    	foreach ($ingredient_data as $key => $row) {
    		$provider[$key]['volumen'] = $unit == 'kilogramo' ? number_format(($row->amount/1000), 2, '.', ',').' Tons' : number_format($row->amount, 2, '.', ',').' Litros';
    		$volumen_total = $volumen_total + $row->amount;
    		if($row->price != 0.00) array_push($precios, $row->price);
    	}

    	$precio_total_prom = round((array_sum($precios)/count($precios)), 2);
    	$volumen_total = $unit == 'kilogramo' ? number_format(($volumen_total/1000), 2, '.', ',').' Tons' : number_format($volumen_total, 2, '.', ',').' Litros';

    	return response()->json(array('provider' => $provider, 'volumen_total' => $volumen_total, 'precio_total_prom' => $precio_total_prom, 'unit' => $unit));
    	*/
    	
    	$volumen_total = 0;
    	$precio_total = 0;
    	$volumen_mes = [];
    	$array_precio_prom = [];
    	$prom = 0;
    	$unit = 'kilogramo';
    	if(!$ingredient_data->isEmpty()) $unit = $ingredient_data[0]->unit == 'kilogramo' ? 'kilogramo' : 'Litro';
    	foreach ($ingredient_data as $key => $row) {
    		$ingredient_data[0]->unit == 'kilogramo' ? array_push($volumen_mes, round($row->amount/1000, 2)) : array_push($volumen_mes, $row->amount);
    		$volumen_total = $volumen_total + $row->amount;

    		array_push($array_precio_prom, $row->price);
    		if($row->price != 0.00) $prom++;
    		$precio_total = $precio_total + $row->price;
    	}
    	$precio_total_prom = $precio_total != 0 ? round($precio_total/$prom, 2) : 0;
    	$volumen_total = $volumen_total != 0 ? $ingredient_data[0]->unit == 'kilogramo' ? round($volumen_total/1000, 2) : $volumen_total : 0;

    	return response()->json(array('volumen_mes' => $volumen_mes, 'volumen_total' => $volumen_total, 'precio_prom_mes' => $array_precio_prom, 'precio_total_prom' => $precio_total_prom, 'trimestres' => count($array_precio_prom),'unit' => $unit));
    	
    }

    public function getIngredientes($categoria_id){
    	$ingredient_data = Analysis_import_ingredient::where('categoria_id', $categoria_id)->orderBy('ingrediente_activo', 'asc')->pluck('ingrediente_activo', 'id')->all();
    	return response()->json(array('ingredientes' => $ingredient_data));
    }

    public function getYears($ingrediente_id){
    	$years = Analysis_import_list::where('analysis_import_ingredient_id', $ingrediente_id)->orderBy('year', 'asc')->pluck('year')->unique()->values()->all();
    	return response()->json(array('years' => $years));
    }


    public function getIngredientsForCuartiles($category_name, $company_id){
    	$proveedor = $company_id == "todas" ? '%' : $company_id;
    	if($category_name == "Otros"){
    		$ingredient_name = Products::whereNotIn('tipo_producto', ['herbicida', 'insecticida', 'fungicida'])
    												->where('proveedor_id', 'like', $proveedor)
			    									->where('ingrediente_activo', '!=', '-')
			    									->orderBy('ingrediente_activo', 'asc')->pluck('ingrediente_activo')->unique()->values()->all();
    	}else{
    		$ingredient_name = Products::where('tipo_producto', $category_name)
    												->where('proveedor_id', 'like', $proveedor)
			    									->where('ingrediente_activo', '!=', '-')
			    									->orderBy('ingrediente_activo', 'asc')->pluck('ingrediente_activo')->unique()->values()->all();
		}

		$final_ingredients = [];
		foreach ($ingredient_name as $value) {
			$current_ingredient = Products::where('ingrediente_activo', '=', $value)->pluck('precio_por_medida')->unique()->values()->all();
			if(count($current_ingredient) > 4) array_push($final_ingredients, $value);
		}

    	return response()->json(array('products' => [], 'ingredients' => $final_ingredients));
    }

    public function analisisCuartil($data_cuartil, $precios, $category_name){
    	/*
			all_data = [
				[
					'title' => 'cuartil 1',
					'value' => 10,
					'companie' => "c1"]
				],
				[
					'cuartil' => 'cuartil 2',
					'value' => 4,
				]...
			]
    	*/

		$total = count($precios);
		if($total < 4) return false;
		//calculo del primer valor cuartil
		$q1 = (($total+1)/4)-1;
		if(is_float($q1)){
			$tmp = ($precios[floor($q1 + 1)] - $precios[floor($q1)])*($q1-floor($q1));
			$first_cuartil = $tmp + $precios[floor($q1)];
		}else{
			$first_cuartil = $precios[$q1];
		}

		//calculo del segundo valor cuartil
		$q2 = (($total+1)/2)-1;
		if(is_float($q2)){
			$tmp = $precios[floor($q2)] + $precios[floor($q2) + 1];
			$second_cuartil = $tmp/2;
		}else{
			$second_cuartil = $precios[$q2];
		}

		//calculo del tercer valor cuartil
		$q3 = ((3*($total+1))/4)-1;
		if(is_float($q3)){
			$tmp = ($precios[floor($q3 + 1)] - $precios[floor($q3)])*($q3-floor($q3));
			$third_cuartil = $tmp + $precios[floor($q3)];
		}else{
			$third_cuartil = $precios[$q3];
		}

		//se separan los cuartiles para simplificar la creacion de la estructura
		$first = [];
		$second = [];
		$third = [];
		$four = [];

		foreach ($precios as $key => $value) {
			if($first_cuartil >= $value) array_push($first, $data_cuartil[$key]);
			else if($second_cuartil >= $value) array_push($second, $data_cuartil[$key]);
			else if($third_cuartil >= $value) array_push($third, $data_cuartil[$key]);
			else array_push($four, $data_cuartil[$key]);
		}

		//se especifican los colores dependiendo del tipo de categoria
		$color_1 = '';
		$color_2 = '';
		$color_3 = '';
		$color_4 = '';

		if($category_name == "Insecticida"){
			$color_1 = '#fdd1c3';
			$color_2 = '#ff7f58';
			$color_3 = '#ff3c00';
			$color_4 = '#b52c02';
		}else if($category_name == "Herbicida"){
			$color_1 = '#cfffd1';
			$color_2 = '#66ff6c';
			$color_3 = '#04b10b';
			$color_4 = '#013503';
		}else if($category_name == "Fungicida"){
			$color_1 = '#faddff';
			$color_2 = '#e886ff';
			$color_3 = '#9e03b9';
			$color_4 = '#440050';
		}else{
			$color_1 = '#fffad1';
			$color_2 = '#f9df00';
			$color_3 = '#ccb700';
			$color_4 = '#716601';
		}

		//se arma la estructura final
		$formatted_q1 = $this->set_cuartiles($first, $color_1);
		$formatted_q2 = $this->set_cuartiles($second, $color_2);
		$formatted_q3 = $this->set_cuartiles($third, $color_3);
		$formatted_q4 = $this->set_cuartiles($four, $color_4);

		$array_merge = array_merge($formatted_q1, $formatted_q2, $formatted_q3, $formatted_q4, array(['title' => '', 'value' => end($precios)*1.5, 'companie' => "", 'color' => '#ffffff']));

		return array('array_merge' => $array_merge, 'colors' => array($color_1, $color_2, $color_3, $color_4));
    }

    public function set_cuartiles($cuartil, $color){
    	$data = [];
    	foreach($cuartil as $key => $value) {
    		if($value->precio_por_medida == 0) continue;
			$tmp = [];
			$tmp['title'] = $value->nombre_producto;
			$tmp['value'] = $value->precio_por_medida;
			$tmp['companie'] = $value->proveedores->nombre_proveedor;
			$tmp['color'] = $color;
			array_push($data, $tmp);
		}
		return $data;
    }
}
