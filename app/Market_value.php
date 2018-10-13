<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market_value extends Model
{
    protected $table = 'market_values';

    public $timestamps = true;

    protected $fillable = ['year', 'pro_insecticida','pro_herbicida', 'pro_fungicida', 'pro_otros', 'pro_total', 'umf_insecticida','umf_herbicida', 'umf_fungicida', 'umf_otros', 'umf_total', 'tipo_de_cambio'];
}
