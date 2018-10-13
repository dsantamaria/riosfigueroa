<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User_login;
use Log;

class User_route extends Model
{
    protected $fillable = [
        'route_id', 'user_login_id',
    ];

    public function user_login()
    {
        return $this->belongsTo('App\User_login', 'user_login_id');
    }

    public function route()
    {
        return $this->belongsTo('App\Route', 'route_id');
    }

    public static function saveRoute($route_id){
        $user_login_id = User_login::get_login()->id;
        self::create([
            'route_id' => $route_id,
            'user_login_id' => $user_login_id,
        ]);
    }

    public static function get_all_routes(){
        $routes = self::all()->groupBy('route_id')->sort()->reverse();
        $all_routes = [];
        foreach ($routes as $value) {
            $count = $value->count();
            $name = $value[0]->route()->first()->route;
            $all_routes[$name] = $count;
        }
        return $all_routes;
    }
}
