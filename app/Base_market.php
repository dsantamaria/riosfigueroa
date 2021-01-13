<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base_market extends Model
{
    protected $fillable = ['id', 'año', 'cultivo', 'estado', 'herbicida', 'insecticida', 'fungicida', 'otro', 'total'];

    public static function getByFarmStateType($farm, $states){
        $baseDate = self::where('cultivo', '=', $farm)
            ->whereIn('estado', $states)
            ->get();

        return $baseDate;
    }

    public static function getByFarmStateTypeArray($farms, $states){
        $baseDate = self::whereIn('cultivo', $farms)
            ->whereIn('estado', $states)
            ->get();

        return $baseDate;
    }
}

