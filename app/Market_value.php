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
    	$total = $data[0][$sector.'_insecticida'] + $data[0][$sector.'_herbicida'] + $data[0][$sector.'_fungicida'] + $data[0][$sector.'_otros'];

		$all_data[0] = array(
    			'title' => 'Insecticida',
    			'value' => (float)$data[0][$sector.'_insecticida'],
    			'value_label' => number_format((float)$data[0][$sector.'_insecticida'], 2),
    			'value_dolar' => (float)number_format($data[0][$sector.'_insecticida']/$data[0]['tipo_de_cambio'], 2, '.', ''),
    			'legend_dolar' => number_format($data[0][$sector.'_insecticida']/$data[0]['tipo_de_cambio'], 2),
    			'color' => $color_ins,
    			'total' => $total,
    			'total_dolar' => $total/$data[0]['tipo_de_cambio'],
                'total_label' => number_format($total, 2),
                'total_dolar_label' => number_format($total/$data[0]['tipo_de_cambio'], 2),
    			'percent' => round(($data[0][$sector.'_insecticida']*100)/$total),
    		);

    	$all_data[1] = array(
    			'title' => 'Herbicida',
    			'value' => (float)$data[0][$sector.'_herbicida'],
    			'value_label' => number_format((float)$data[0][$sector.'_herbicida'], 2),
    			'value_dolar' => (float)number_format(($data[0][$sector.'_herbicida'])/$data[0]['tipo_de_cambio'], 2, '.', ''),
    			'legend_dolar' => number_format(($data[0][$sector.'_herbicida'])/$data[0]['tipo_de_cambio'], 2),
    			'color' => $color_her,
    			'percent' => round(($data[0][$sector.'_herbicida']*100)/$total),
    		);
   		$all_data[2] = array(
    			'title' => 'Fungicida',
    			'value' => (float)$data[0][$sector.'_fungicida'],
    			'value_label' => number_format((float)$data[0][$sector.'_fungicida'], 2),
    			'value_dolar' => (float)number_format(($data[0][$sector.'_fungicida'])/$data[0]['tipo_de_cambio'], 2, '.', ''),
    			'legend_dolar' => number_format(($data[0][$sector.'_fungicida'])/$data[0]['tipo_de_cambio'], 2),
    			'color' => $color_fun,
    			'percent' => round(($data[0][$sector.'_fungicida']*100)/$total),
    		);

    	$all_data[3] = array(
    			'title' => 'Otros',
    			'value' => (float)$data[0][$sector.'_otros'],
    			'value_label' => number_format((float)$data[0][$sector.'_otros'], 2),
    			'value_dolar' => (float)number_format(($data[0][$sector.'_otros'])/$data[0]['tipo_de_cambio'], 2, '.', ''),
    			'legend_dolar' => number_format(($data[0][$sector.'_otros'])/$data[0]['tipo_de_cambio'], 2),
    			'color' => $color_otr,
    			'percent' => round(($data[0][$sector.'_otros']*100)/$total),
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
        $projection = self::projection($pro, $umf, $data, false);
        $projection_dol = self::projection($pro, $umf, $data, true);

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
                'projection'           => $projection['a0'] + ($projection['a1'] * ($key +1)),
                'projection_dol'       => $projection_dol['a0'] + ($projection_dol['a1'] * ($key +1)),

    			'pro_percent'		   => round(($value[$pro] * 100)/$suma),
    			'umf_percent'		   => round(($value[$umf] * 100)/$suma),
    		);
    	}
        /*
        array_push($all_data, array(
            'projection'     => $projection['a0'] + ($projection['a1'] * 11),
            'projection_dol' => $projection_dol['a0'] + ($projection_dol['a1'] * 11),
            'year'           => "",        
        ));*/

    	return $all_data;
    }

    public static function projection($pro, $umf, $data, $dol){
        $y = [];
        $x = [];
        $xy = [];
        $x2 = [];
        $y2 = [];
        $n = 0;
        $a0 = 0;
        $a1 = 0;

        /*projection chart*/
        foreach ($data as $key => $value) {
            $total = $dol ? $value[$pro]/$value['tipo_de_cambio'] + $value[$umf]/$value['tipo_de_cambio'] : $value[$pro] + $value[$umf];
            array_push($x, $key + 1);
            array_push($y, $total);
            array_push($xy, ($key + 1) * ($total));
            array_push($x2, ($key + 1)*($key + 1));
            array_push($y2, ($total)*($total));
            $n = $key + 1;
        }
        
        $total_y = array_sum($y);
        $total_x = array_sum($x);
        $total_xy = array_sum($xy);
        $total_x2 = array_sum($x2);
        $total_y2 = array_sum($y2);

        $a0 = (($total_y * $total_x2) - ($total_x*$total_xy))/(($n*$total_x2) - ($total_x * $total_x));
        $a1 = (($n*$total_xy) - ($total_x*$total_y))/(($n*$total_x2) - ($total_x * $total_x));

        return array('a0' => $a0, 'a1' => $a1);
    }
}
