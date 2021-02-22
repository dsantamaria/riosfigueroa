<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market_modality extends Model
{
    protected $table = 'market_modalities';

    public $timestamps = true;

    protected $fillable = ['nombre'];

    public function marketData()
    {
        return $this->hasMany('App\Market_data', 'modalidadid');
    }
}
