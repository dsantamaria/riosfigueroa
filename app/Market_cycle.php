<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market_cycle extends Model
{
    protected $table = 'market_cycles';

    public $timestamps = true;

    protected $fillable = ['nombre'];

    public function marketData()
    {
        return $this->hasMany('App\Market_data', 'cicloId');
    }
}
