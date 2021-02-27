<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market_data extends Model
{
    protected $table = 'market_datas';

    public $timestamps = true;

    protected $fillable = ['entidadId', 'cicloId', 'tecnologiaid', 'ano', 'supsembrada', 'supcocechada', 'supsiniestrada', 'produccion', 'rendimiento', 'pmr', 'valorpesos', 'modalidadid', 'cultivoid'];

    public function marketCycle()
    {
        return $this->belongsTo('App\Market_cycle', 'cicloId');
    }

    public function marketEntity()
    {
        return $this->belongsTo('App\Market_entity');
    }

    public function marketFarm()
    {
        return $this->belongsTo('App\Market_farm');
    }

    public function marketModality()
    {
        return $this->belongsTo('App\Market_modality');
    }

    public function marketTechnology()
    {
        return $this->belongsTo('App\Market_technology');
    }
}
