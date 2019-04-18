<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\User_login;
use DB;
use Log;

class AdminController extends Controller
{
	public function index(){
		$users = User::all();
    	return view('admin.index')->with('users', $users);
	}

	public function create(){
		return view('admin.create');
	}

    public function saveAdmin(Request $request)
    {	
    	$this->validate($request, [
    		'name' 					=> 'required',
	        'email'					=> 'required|unique:users,email|max:255',
	        'password' 				=> 'required|min:6|confirmed',
	        'password_confirmation' => 'required',
	    ]);

    	$admin = User::createAdmin($request->all());

    	Log::debug($admin);

        return back()->with('success', 'Admin '.$admin->name.' ha sido creado con éxito!');
    }

    public function deleteAdmin($id){
        $user = User::where('id', $id)->delete();
        if($user){
            DB::table('role_users')->where('user_id', $id)->delete();
            return response()->json(['response' => 1]);
        }
        return response()->json(['response' => 0]);
    }

    public function activateAdmin($id, $state){
        $user = User::where('id', $id)->update(['active' => $state]);
        if($user){
            return response()->json(['response' => 1]);
        }
        return response()->json(['response' => 0]);
    }
}