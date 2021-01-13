<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MexicoState extends Model
{
    protected $fillable = ['id', 'alias', 'name'];
    
    public static function getStates(){
        return self::all();
    }

}
