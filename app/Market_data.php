<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market_data extends Model
{
    protected $table = 'market_datas';

    public $timestamps = true;

    protected $fillable = ['entidadid', 'cicloid', 'tecnologiaid', 'ano', 'supsembrada', 'supcocechada', 'supsiniestrada', 'produccion', 'rendimiento', 'pmr', 'valorpesos', 'modalidadid', 'cultivoid', 'medidaid'];

    public function marketCycle()
    {
        return $this->belongsTo('App\Market_cycle', 'cicloid');
    }

    public function marketEntity()
    {
        return $this->belongsTo('App\Market_entity', 'entidadid');
    }

    public function marketFarm()
    {
        return $this->belongsTo('App\Market_farm', 'cultivoid');
    }

    public function marketModality()
    {
        return $this->belongsTo('App\Market_modality', 'modalidadid');
    }

    public function marketTechnology()
    {
        return $this->belongsTo('App\Market_technology', 'tecnologiaid');
    }

    public static function get_all_per_state_farm($farmsIds, $stateIds){
        return self::where('ano', 2019)
            ->where('tecnologiaid', 0)
            ->whereIn('cicloid', [3, 4])
            ->where('modalidadid', 3)
            ->whereIn('entidadId', $stateIds)
            ->whereIn('cultivoid', $farmsIds)
            ->get();
    }

    public static function get_all_data_for_states($farmsIds){
        return self::where('ano', 2019)
            ->where('tecnologiaid', 0)
            ->whereIn('cicloid', [3, 4])
            ->where('modalidadid', 3)
            ->whereIn('cultivoid', $farmsIds)
            ->get();
    }
}
