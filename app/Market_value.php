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

    public static function data_from_specific_year($year, $sector){
    	$data = self::where('year', $year)->get();
    	$all_data = [];
    	//$color_pro = '#e05651';
    	//$color_umf = '#087b71';
    	$color_ins = '#ff3c00';
    	$color_her = '#04b10b';
    	$color_fun = '#9e03b9';
    	$color_otr = '#ccb700';
    	$value_insecticida = $sector == 'total' ? ($data[0]['umf_insecticida']+$data[0]['pro_insecticida']) : $data[0][$sector.'_insecticida'];
        $value_herbicida = $sector == 'total' ? ($data[0]['umf_herbicida']+$data[0]['pro_herbicida']) : $data[0][$sector.'_herbicida'];
        $value_fungicida = $sector == 'total' ? ($data[0]['umf_fungicida']+$data[0]['pro_fungicida']) : $data[0][$sector.'_fungicida'];
        $value_otros = $sector == 'total' ? ($data[0]['umf_otros']+$data[0]['pro_otros']) : $data[0][$sector.'_otros'];
        $total = $value_insecticida + $value_herbicida + $value_fungicida + $value_otros;

		$all_data[0] = array(
    			'title' => 'Insecticida',
    			'value' => (float)$value_insecticida,
    			'value_label' => number_format((float)$value_insecticida, 2),
    			'value_dolar' => (float)number_format($value_insecticida/$data[0]['tipo_de_cambio'], 2, '.', ''),
    			'legend_dolar' => number_format($value_insecticida/$data[0]['tipo_de_cambio'], 2),
    			'color' => $color_ins,
    			'total' => $total,
    			'total_dolar' => $total/$data[0]['tipo_de_cambio'],
                'total_label' => number_format($total, 2),
                'total_dolar_label' => number_format($total/$data[0]['tipo_de_cambio'], 2),
    			'percent' => round(($value_insecticida*100)/$total),
    		);

    	$all_data[1] = array(
    			'title' => 'Herbicida',
    			'value' => (float)$value_herbicida,
    			'value_label' => number_format((float)$value_herbicida, 2),
    			'value_dolar' => (float)number_format(($value_herbicida)/$data[0]['tipo_de_cambio'], 2, '.', ''),
    			'legend_dolar' => number_format(($value_herbicida)/$data[0]['tipo_de_cambio'], 2),
    			'color' => $color_her,
    			'percent' => round(($value_herbicida*100)/$total),
    		);
   		$all_data[2] = array(
    			'title' => 'Fungicida',
    			'value' => (float)$value_fungicida,
    			'value_label' => number_format((float)$value_fungicida, 2),
    			'value_dolar' => (float)number_format(($value_fungicida)/$data[0]['tipo_de_cambio'], 2, '.', ''),
    			'legend_dolar' => number_format(($value_fungicida)/$data[0]['tipo_de_cambio'], 2),
    			'color' => $color_fun,
    			'percent' => round(($value_fungicida*100)/$total),
    		);

    	$all_data[3] = array(
    			'title' => 'Otros',
    			'value' => (float)$value_otros,
    			'value_label' => number_format((float)$value_otros, 2),
    			'value_dolar' => (float)number_format(($value_otros)/$data[0]['tipo_de_cambio'], 2, '.', ''),
    			'legend_dolar' => number_format(($value_otros)/$data[0]['tipo_de_cambio'], 2),
    			'color' => $color_otr,
    			'percent' => round(($value_otros*100)/$total),
    		);
    	
    	$exchange = $data[0]['tipo_de_cambio'];
    	return array('all_data' => $all_data, 'exchange' => $exchange);
    }


    public static function data_from_all_years($sector){
    	$data = self::all();

    	$all_data = [];
    	$round_suma = 0;
    	$suma = 0;
    	$pro = 'pro_'.$sector;
    	$umf = 'umf_'.$sector;

        /*yearly column chart*/
    	foreach ($data as $key => $value) {

    		if($sector == 'todos'){
    			$pro = 'pro_total';
    			$umf = 'umf_total';
    		}

    		$suma = $value[$pro] + $value[$umf];
    		$suma_dol = $suma/$value['tipo_de_cambio'];

    		if($suma >= 1000000){
    			$round_suma = number_format($suma/1000000, 1).'M';
    		}elseif($suma <1000000){
    			$round_suma = number_format($suma/1000, 1).'K';
    		}

    		if($suma_dol >= 1000000){
    			$round_suma_dol = number_format(($suma_dol/1000000), 1).'M';
    		}elseif($suma_dol <1000000){
    			$round_suma_dol = number_format(($suma_dol/1000), 1).'K';
    		}

    		$all_data[$key] = array(
    			'year'                 => $value['year'],
    			'pro_total'            => $value[$pro],
    			'umf_total' 	       => $value[$umf],
    			'pro_total_ballon'     => number_format($value[$pro], 1),
    			'umf_total_ballon'     => number_format($value[$umf], 1),
    			'pro_total_dol'        => $value[$pro] / $value['tipo_de_cambio'],
    			'umf_total_dol' 	   => $value[$umf] / $value['tipo_de_cambio'],
    			'pro_total_ballon_dol' => number_format(($value[$pro] / $value['tipo_de_cambio']), 1),
    			'umf_total_ballon_dol' => number_format(($value[$umf] / $value['tipo_de_cambio']), 1),
    			'exchange'             => $value['tipo_de_cambio'],
    			'suma'		           => number_format(($suma), 1),
    			'suma_dol'		       => number_format(($suma_dol), 1),
    			'round_suma'	       => '$'.$round_suma,
    			'round_suma_dol'	   => '$'.$round_suma_dol,

    			'pro_percent'		   => round(($value[$pro] * 100)/$suma),
    			'umf_percent'		   => round(($value[$umf] * 100)/$suma),
    		);
    	}

    	return $all_data;
    }
}
