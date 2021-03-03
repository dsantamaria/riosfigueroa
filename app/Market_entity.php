<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market_entity extends Model
{
    protected $table = 'market_entities';

    public $timestamps = true;

    protected $fillable = ['nombre'];

    public function marketData()
    {
        return $this->hasMany('App\Market_data', 'entidadid');
    }

    public static function getByName($name){
        return self::where('nombre', $name)->first();
    }
}
