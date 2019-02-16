<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\User_login;
use App\User_route;
use Auth;
use Gate;

use Log;

class UserActivityController extends Controller
{
	public function index(){
		$all_routes = User_route::get_all_routes();
		$all_logins = User_login::get_all_logins();
		return view('user_activity.index')->with(['all_routes' => $all_routes, 'all_logins' => $all_logins]);
	}

    public function updateTimer(){
    	if(Auth::check() && Gate::denies('admin-role')){
            User_login::update_open_session(Auth::user()->id);
        }
    }

    public function userInfo($id){
    	$logins = User_login::where('user_id', $id)->orderBy('date_in', 'desc')->get();
    	$first_date_routes = $logins[0]->user_routes()->get();

    	$logins_id = $logins->pluck(['id']);
    	$routes_visited = User_route::whereIn('user_login_id', $logins_id)->get()->groupBy('route_id')->sort()->reverse();

    	return view('user_activity.userInfo')->with(['logins' => $logins, 'first_date_routes' => $first_date_routes ,'routes_visited' => $routes_visited]);
    }

    public function getDateInfo($id){
    	$date_routes = User_route::where('user_login_id', $id)->with('route')->get();
    	return response()->json(array('date_routes' => $date_routes));
    }

    public function changePassword(){
        return view('user_activity.changePassword');
    }

    public function savePassword(Request $request){
        
        $this->validate($request,[
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();

        $user->password = bcrypt($request['password']);
        $user->save(); 


        session()->flash('success', 'Contraseña establecida exitosamente.');

        return view('user_activity.changePassword');
    }
}
