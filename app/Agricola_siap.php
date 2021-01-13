<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agricola_siap extends Model
{
    protected $fillable = ['anio', 'mes','estado', 'producto', 'superficie_sembrada', 'superficie_siniestrada', 'superficie_cosechada', 'produccion_obtenida', 'rendimiento_obtenido'];
    
    public static function get_all_per_farm_farm($states, $farms){
        $data = self::whereBetween('mes', [0, 13])
            ->whereIn('estado', $states)
            ->whereIn('producto', $farms)
            ->get();
        
        return $data;
    }

    public static function get_all_data_for_states($farms){
        $data = self::whereBetween('mes', [0, 13])
            ->whereIn('producto', $farms)
            ->get();
        
        return $data;
    }
}
