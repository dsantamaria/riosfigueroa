<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Market_value extends Model
{
    protected $table = 'market_values';

    public $timestamps = true;

    protected $fillable = ['year', 'pro_insecticida','pro_herbicida', 'pro_fungicida', 'pro_otros', 'pro_total', 'umf_insecticida','umf_herbicida', 'umf_fungicida', 'umf_otros', 'umf_total', 'tipo_de_cambio'];


    public static function getYears(){
    	$data = self::all();
    	$years = [];
    	foreach ($data as $value) {
    		$years[$value['year']] = $value['year'];
    	}
    	return $years;
    }

    public static function data_from_specific_year($year, $analisis){
    	$data = self::where('year', $year)->get();
    	$all_data = [];
    	$color_pro = '#e05651';
    	$color_umf = '#087b71';
    	$color_ins = '#ff3c00';
    	$color_her = '#04b10b';
    	$color_fun = '#9e03b9';
    	$color_otr = '#ccb700';
    	if($analisis == 1){
    		$all_data[0] = array(
	    			'title' => 'PROCCYT',
	    			'value' => (float)$data[0]['pro_total'],
	    			'value_dolar' => (float)number_format(($data[0]['pro_total'] / $data[0]['tipo_de_cambio']), 2, '.', ''),
	    			'legend_dolar' => number_format(($data[0]['pro_total'] / $data[0]['tipo_de_cambio']), 2),
	    			'color' => $color_pro,
	    			'data' => array(
	    				array(
	    					'title' => 'Insecticida',
	    					'value' => (float)$data[0]['pro_insecticida'],
	    					'value_dolar' => (float)number_format(($data[0]['pro_insecticida'] / $data[0]['tipo_de_cambio']), 2, '.', ''),
	    					'legend_dolar' => number_format(($data[0]['pro_insecticida'] / $data[0]['tipo_de_cambio']), 2),
	    					'color' => $color_ins,
	    				),
	    				array(
	    					'title' => 'Herbicida',
	    					'value' => (float)$data[0]['pro_herbicida'],
	    					'value_dolar' => (float)number_format(($data[0]['pro_herbicida'] / $data[0]['tipo_de_cambio']), 2, '.', ''),
	    					'legend_dolar' => number_format(($data[0]['pro_herbicida'] / $data[0]['tipo_de_cambio']), 2),
	    					'color' => $color_her,
	    				),
	    				array(
	    					'title' => 'Fungicida',
	    					'value' => (float)$data[0]['pro_fungicida'],
	    					'value_dolar' => (float)number_format(($data[0]['pro_fungicida'] / $data[0]['tipo_de_cambio']), 2, '.', ''),
	    					'legend_dolar' => number_format(($data[0]['pro_fungicida'] / $data[0]['tipo_de_cambio']), 2),
	    					'color' => $color_fun,
	    				),
	    				array(
	    					'title' => 'Otros',
	    					'value' => (float)$data[0]['pro_otros'],
	    					'value_dolar' => (float)number_format(($data[0]['pro_otros'] / $data[0]['tipo_de_cambio']), 2, '.', ''),
	    					'legend_dolar' => number_format(($data[0]['pro_otros'] / $data[0]['tipo_de_cambio']), 2),
	    					'color' => $color_otr,
	    				),
	    			),
	    		);

	    	$all_data[1] = array(
	    			'title' => 'UMFFAAC',
	    			'value' => (float)$data[0]['umf_total'],
	    			'value_dolar' => (float)number_format(($data[0]['umf_total'] / $data[0]['tipo_de_cambio']), 2, '.', ''),
	    			'legend_dolar' => number_format(($data[0]['umf_total'] / $data[0]['tipo_de_cambio']), 2),
	    			'color' => $color_umf,
	    			'data' => array(
	    				array(
	    					'title' => 'Insecticida',
	    					'value' => (float)$data[0]['umf_insecticida'],
	    					'value_dolar' => (float)number_format(($data[0]['umf_insecticida'] / $data[0]['tipo_de_cambio']), 2, '.', ''),
	    					'legend_dolar' => number_format(($data[0]['umf_insecticida'] / $data[0]['tipo_de_cambio']), 2),
	    					'color' => $color_ins,
	    				),
	    				array(
	    					'title' => 'Herbicida',
	    					'value' => (float)$data[0]['umf_herbicida'],
	    					'value_dolar' => (float)number_format(($data[0]['umf_herbicida'] / $data[0]['tipo_de_cambio']), 2, '.', ''),
	    					'legend_dolar' => number_format(($data[0]['umf_herbicida'] / $data[0]['tipo_de_cambio']), 2),
	    					'color' => $color_her,
	    				),
	    				array(
	    					'title' => 'Fungicida',
	    					'value' => (float)$data[0]['umf_fungicida'],
	    					'value_dolar' => (float)number_format(($data[0]['umf_fungicida'] / $data[0]['tipo_de_cambio']), 2, '.', ''),
	    					'legend_dolar' => number_format(($data[0]['umf_fungicida'] / $data[0]['tipo_de_cambio']), 2),
	    					'color' => $color_fun,
	    				),
	    				array(
	    					'title' => 'Otros',
	    					'value' => (float)$data[0]['umf_otros'],
	    					'value_dolar' => (float)number_format(($data[0]['umf_otros'] / $data[0]['tipo_de_cambio']), 2, '.', ''),
	    					'legend_dolar' => number_format(($data[0]['umf_otros'] / $data[0]['tipo_de_cambio']), 2),
	    					'color' => $color_otr,
	    				),
	    			),
	    		);
    	}

    	if($analisis == 2){
    		$all_data[0] = array(
	    			'title' => 'Insecticida',
	    			'value' => (float)$data[0]['pro_insecticida'] +  $data[0]['umf_insecticida'],
	    			'value_dolar' => (float)number_format(($data[0]['pro_insecticida'] + $data[0]['umf_insecticida'])/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    			'legend_dolar' => number_format(($data[0]['pro_insecticida'] + $data[0]['umf_insecticida'])/$data[0]['tipo_de_cambio'], 2),
	    			'color' => $color_ins,
	    			'data' => array(
	    				array(
	    					'title' => 'PROCCYT Insecticida',
	    					'value' => (float)$data[0]['pro_insecticida'],
	    					'value_dolar' => (float)number_format($data[0]['pro_insecticida']/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    					'legend_dolar' => number_format($data[0]['pro_insecticida']/$data[0]['tipo_de_cambio'], 2),
	    					'color' => $color_pro,
	    				),
	    				array(
	    					'title' => 'UMFFAAC Insecticida',
	    					'value' => (float)$data[0]['umf_insecticida'],
	    					'value_dolar' => (float)number_format($data[0]['umf_insecticida']/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    					'legend_dolar' => number_format($data[0]['umf_insecticida']/$data[0]['tipo_de_cambio'], 2),
	    					'color' => $color_umf,
	    				),
	    			),
	    		);

	    	$all_data[1] = array(
	    			'title' => 'Herbicida',
	    			'value' => (float)$data[0]['pro_herbicida'] +  $data[0]['umf_herbicida'],
	    			'value_dolar' => (float)number_format(($data[0]['pro_herbicida'] + $data[0]['umf_herbicida'])/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    			'legend_dolar' => number_format(($data[0]['pro_herbicida'] + $data[0]['umf_herbicida'])/$data[0]['tipo_de_cambio'], 2),
	    			'color' => $color_her,
	    			'data' => array(
	    				array(
	    					'title' => 'PROCCYT Herbicida',
	    					'value' => (float)$data[0]['pro_herbicida'],
	    					'value_dolar' => (float)number_format($data[0]['pro_herbicida']/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    					'legend_dolar' => number_format($data[0]['pro_herbicida']/$data[0]['tipo_de_cambio'], 2),
	    					'color' => $color_pro,
	    				),
	    				array(
	    					'title' => 'UMFFAAC Herbicida',
	    					'value' => (float)$data[0]['umf_herbicida'],
	    					'value_dolar' => (float)number_format($data[0]['umf_herbicida']/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    					'legend_dolar' => number_format($data[0]['umf_herbicida']/$data[0]['tipo_de_cambio'], 2),
	    					'color' => $color_umf,
	    				),
	    			),
	    		);
	    $all_data[2] = array(
	    			'title' => 'Fungicida',
	    			'value' => (float)$data[0]['pro_fungicida'] +  $data[0]['umf_fungicida'],
	    			'value_dolar' => (float)number_format(($data[0]['pro_fungicida'] + $data[0]['umf_fungicida'])/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    			'legend_dolar' => number_format(($data[0]['pro_fungicida'] + $data[0]['umf_fungicida'])/$data[0]['tipo_de_cambio'], 2),
	    			'color' => $color_fun,
	    			'data' => array(
	    				array(
	    					'title' => 'PROCCYT Fungicida',
	    					'value' => (float)$data[0]['pro_fungicida'],
	    					'value_dolar' => (float)number_format($data[0]['pro_fungicida']/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    					'legend_dolar' => number_format($data[0]['pro_fungicida']/$data[0]['tipo_de_cambio'], 2),
	    					'color' => $color_pro,
	    				),
	    				array(
	    					'title' => 'UMFFAAC Fungicida',
	    					'value' => (float)$data[0]['umf_fungicida'],
	    					'value_dolar' => (float)number_format($data[0]['umf_fungicida']/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    					'legend_dolar' => number_format($data[0]['umf_fungicida']/$data[0]['tipo_de_cambio'], 2),
	    					'color' => $color_umf,
	    				),
	    			),
	    		);

	    	$all_data[3] = array(
	    			'title' => 'Otros',
	    			'value' => (float)$data[0]['pro_otros'] +  $data[0]['umf_otros'],
	    			'value_dolar' => (float)number_format(($data[0]['pro_otros'] + $data[0]['umf_otros'])/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    			'legend_dolar' => number_format(($data[0]['pro_otros'] + $data[0]['umf_otros'])/$data[0]['tipo_de_cambio'], 2),
	    			'color' => $color_otr,
	    			'data' => array(
	    				array(
	    					'title' => 'PROCCYT Otros',
	    					'value' => (float)$data[0]['pro_otros'],
	    					'value_dolar' => (float)number_format($data[0]['pro_otros']/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    					'legend_dolar' => number_format($data[0]['pro_otros']/$data[0]['tipo_de_cambio'], 2),
	    					'color' => $color_pro,
	    				),
	    				array(
	    					'title' => 'UMFFAAC Otros',
	    					'value' => (float)$data[0]['umf_otros'],
	    					'value_dolar' => (float)number_format($data[0]['umf_otros']/$data[0]['tipo_de_cambio'], 2, '.', ''),
	    					'legend_dolar' => number_format($data[0]['umf_otros']/$data[0]['tipo_de_cambio'], 2),
	    					'color' => $color_umf,
	    				),
	    			),
	    		);
    	}
    	
    	$exchange = $data[0]['tipo_de_cambio'];
    	return array('all_data' => $all_data, 'exchange' => $exchange);
    }


    public static function data_from_all_years(){
    	$data = self::all();
    	$all_data = [];
    	$round_suma = 0;
    	$suma = 0;

    	foreach ($data as $key => $value) {
    		$suma = $value['pro_total'] + $value['umf_total'];
    		$suma_dol = $suma/$value['tipo_de_cambio'];

    		if($suma >= 1000000){
    			$round_suma = number_format($suma/1000000, 2).'M';
    		}elseif($suma <1000000){
    			$round_suma = number_format($suma/1000, 2).'K';
    		}

    		if($suma_dol >= 1000000){
    			$round_suma_dol = number_format(($suma_dol/1000000), 2).'M';
    		}elseif($suma_dol <1000000){
    			$round_suma_dol = number_format(($suma_dol/1000), 2).'K';
    		}

    		$all_data[$key] = array(
    			'year'                 => $value['year'],
    			'pro_total'            => $value['pro_total'],
    			'umf_total' 	       => $value['umf_total'],
    			'pro_total_ballon'     => number_format($value['pro_total'], 2),
    			'umf_total_ballon'     => number_format($value['umf_total'], 2),
    			'pro_total_dol'        => (float)number_format(($value['pro_total'] / $value['tipo_de_cambio']), 2),
    			'umf_total_dol' 	   => (float)number_format(($value['umf_total'] / $value['tipo_de_cambio']), 2),
    			'pro_total_ballon_dol' => number_format(($value['pro_total'] / $value['tipo_de_cambio']), 2),
    			'umf_total_ballon_dol' => number_format(($value['umf_total'] / $value['tipo_de_cambio']), 2),
    			'exchange'             => $value['tipo_de_cambio'],
    			'suma'		           => number_format(($suma), 2),
    			'suma_dol'		       => number_format(($suma_dol), 2),
    			'round_suma'	       => $round_suma,
    			'round_suma_dol'	   => $round_suma_dol,
    		);
    	}

    	return $all_data;
    }
}
