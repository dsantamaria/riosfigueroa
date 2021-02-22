<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region_state extends Model
{
    protected $table = 'region_states';

    public $timestamps = true;

    protected $fillable = ['state_id', 'region_id'];

    public function mexicoStates()
    {
        return $this->belongsTo('App\MexicoState', 'state_id');
    }

    public function userRegions()
    {
        return $this->belongsTo('App\User_region', 'region_id');
    }

    public static function saveUserRegion($regionId, $stateId){
        self::create([
            'state_id' => $stateId,
            'region_id' => $regionId
        ]);
    }
}
