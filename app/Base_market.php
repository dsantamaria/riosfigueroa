<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base_market extends Model
{
    protected $fillable = ['id', 'año', 'cultivo', 'estado', 'herbicida', 'insecticida', 'fungicida', 'otro', 'total'];

    public static function getByFarmStateType($farm, $states, $year){
        $baseDate = self::where('cultivo', '=', $farm)
            ->where('año', $year)
            ->whereIn('estado', $states)
            ->get();

        return $baseDate;
    }

    public static function getByFarmStateTypeArray($farms, $states, $year){
        $baseDate = self::whereIn('cultivo', $farms)
            ->where('año', $year)
            ->whereIn('estado', $states)
            ->get();

        return $baseDate;
    }
}

