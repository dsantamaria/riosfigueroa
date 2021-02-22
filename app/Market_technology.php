<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market_technology extends Model
{
    protected $table = 'market_technologies';

    public $timestamps = true;

    protected $fillable = ['nombre'];

    public function marketData()
    {
        return $this->hasMany('App\Market_data', 'tecnologiaid');
    }
}
