<?php

namespace App;
use App\User;
use Carbon\Carbon;
use Auth;
use Log;

use Illuminate\Database\Eloquent\Model;

class User_login extends Model
{
    protected $fillable = [
        'user_id', 'status', 'date_in', 'time'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function user_routes()
    {
        return $this->hasMany('App\User_route');
    }
    
    public static function save_login(User $user){
    	self::close_login_if_exist($user);
    	self::create([
			'user_id' => $user->id,
			'status'  => 'open',
			'date_in' => Carbon::now()
		]);
    }

    public static function close_login_if_exist(User $user){
    	self::where('user_id', $user->id)->where('status', 'open')->update(['status' => 'close']);
    }

    public static function update_open_session($user_id){
    	$user_session = self::where('user_id', $user_id)->where('status', 'open')->first();
    	$user_session->time = $user_session->time + 30;
    	$user_session->save();
    }

    public static function get_login(){
        return self::where('user_id', Auth::user()->id)->where('status', 'open')->first();
    }

    public static function get_all_logins(){
        $logins = self::all()->groupBy('user_id')->sort()->reverse();
        $all_logins = [];
        foreach ($logins as $key => $value) {
            $user_login = [];
            $user_login['count'] = $value->count();
            $user_login['name'] = $value[0]->user()->first()->name;
            $user_login['avg'] = ceil($value->avg('time')/60);
            $user_login['min'] = ceil($value->min('time')/60);
            $user_login['max'] = ceil($value->max('time')/60);
            $user_login['id'] = $key;
            array_push($all_logins, $user_login);
        }
        return $all_logins;
    }
}
