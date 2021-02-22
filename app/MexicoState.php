<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MexicoState extends Model
{
    protected $fillable = ['id', 'alias', 'name'];

    public function regionStates(){
        return $this->hasMany('App\Region_state');
    }
    
    public static function getStates(){
        return self::all();
    }

    public static function getStateByAlias($alias){
        return self::where('alias', $alias)->first();
    }

}
