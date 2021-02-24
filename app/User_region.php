<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_region extends Model
{
    protected $table = 'user_regions';

    public $timestamps = true;

    protected $fillable = ['id', 'name', 'user_id'];

    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function regionStates(){
        return $this->hasMany('App\Region_state', 'region_id');
    }

    public static function saveRegion($name, $user_id){
        return self::create([
            'name' => $name, 
            'user_id' => $user_id
        ]);
    }

    public static function getByUser($user_id){
        return self::where('user_id', $user_id)->get();
    }

    public static function deleteRegion($id){
        self::destroy($id);
    }
}
