<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable = ['id', 'farm'];
    
    public static function getFarms(){
        return self::all();
    }

}
