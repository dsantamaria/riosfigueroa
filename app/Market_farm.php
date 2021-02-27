<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market_farm extends Model
{
    protected $table = 'market_farm';

    public $timestamps = true;

    protected $fillable = ['nombre'];

    public function marketData()
    {
        return $this->hasMany('App\Market_data', 'cultivoid');
    }
}
