<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agricola_siap extends Model
{
    protected $fillable = ['anio', 'mes','estado', 'producto', 'superficie_sembrada', 'superficie_siniestrada', 'superficie_cosechada', 'produccion_obtenida', 'rendimiento_obtenido'];
    
    public static function get_all_per_state_farm($states, $farms){
        $mes = self::max('mes');
        $anio = self::max('anio');

        $data = self::where('mes', '=', $mes)
            ->where('anio', '=', $anio)
            ->whereIn('estado', $states)
            ->whereIn('producto', $farms)
            ->get();
        
        return $data;
    }

    public static function get_all_data_for_states($farms){
        $mes = self::max('mes');
        $anio = self::max('anio');
        
        $data = self::where('mes', '=', $mes)
            ->where('anio', '=', $anio)
            ->whereIn('producto', $farms)
            ->get();
        
        return $data;
    }

}
