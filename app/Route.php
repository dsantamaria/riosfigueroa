<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'route',
    ];

    public function user_routes()
    {
        return $this->hasMany('App\User_route');
    }

    public static function getRoute($route){
        return self::where('route', $route)->first();
    }
}
