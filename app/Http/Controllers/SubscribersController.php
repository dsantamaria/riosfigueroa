<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Company_subscriber;
use App\User;
use App\Pending_subscriber;
use Mail;
use Carbon\Carbon;
use Log;


class SubscribersController extends Controller
{
    public function subscriber_form(){
    	return view('subscribers.form');
    }

    public function saveSubscriberForm(Request $request){
    	$this->validate($request, [
    		'company_name' => 'required|unique:company_subscribers,company_name|min:1|max:255|',
    		'email' => 'required|unique:company_subscribers,email|min:1'
    	]);

    	Company_subscriber::save_company_subscriber($request);

    	return back()->with('success','Suscripción exitosa.');
    }

    public function sendSubscription(){
    	return view('subscribers.send_subscription');
    }

    public function sendSubscriptionEmail(Request $request){
    	$this->validate($request, [
    		'email' => 'required'
    	]);
    	
    	$email = $request['email'];

    	//transaccion ejecutada para asegurar que la informacion se guarde en las tablas Users y Pending_subscribers o en ninguna
    	DB::beginTransaction();
        //se crea el tokenn
        $token = sha1(time());
        $current_time = Carbon::now();
        $user = User::where('email', $email)->get();

    	try{
            if($user->count() > 0){
                //si el usuario existe y no esta activo se reenvia/actualiza el token, sino se aborta el proceso ya que esta activo 
                if ($user[0]['active'] == 0 ){
                    DB::table('pending_subscribers')->where('user_id', $user[0]['id'])->update(['token' => $token, 'updated_at' => $current_time]);
                }
                else{
                    return back()->with('warning','El usuario '. $email . ' se encuentra activo');
                }
            }else{
                //se crea el usuario nuevo 
               $user_id = DB::table('users')->insertGetId(
                    ['email' => $email, 'created_at' => $current_time, 'updated_at' => $current_time]
                );

                //se crea el usuario pendiente 
                DB::table('pending_subscribers')->insert(
                    ['token' => $token, 'user_id' => $user_id, 'created_at' => $current_time, 'updated_at' => $current_time] 
                );

                //se asigna el role de usuario '3'
                DB::table('role_users')->insert(
                    ['role_id' => 3, 'user_id' => $user_id,]
                );
            }

    		DB::commit();

    		//envio del email
    		$url = url('/registerPending?tok='.$token);
	        Mail::queue('emails.subscriber', ['url' => $url], function ($m) use ($email) {
	            $m->from('suscripciones@riosfigueroa.net', 'Rios figueroa');
	            $m->to($email)->subject('Completa la suscripcion!');
	        });
    	}catch(\Exception $e){
    		DB::rollback();
    		return back()->with('warning','Ocurrio un error al enviar el email a '. $email . '. Por favor intente de nuevo');
    	}

        return back()->with('success','Email enviado con exito a '. $email);
    }

    public function showRegistrationFormPending(Request $request)
    {
    	$user_token = Pending_subscriber::where('token', $request['tok'])->first();
    	if($user_token){
    		$date_valid = Carbon::now()->diffInDays($user_token['updated_at']);
    		if($date_valid >= 3){
    			return redirect('login')->with('warning', 'Este enlace ya expiro');
    		}
    		$email = $user_token->user->email;
        	return view('subscribers.update_user')->with('email', $email)->with('token', $user_token['token']);
    	}
    	return redirect('login')->with('warning', 'Direccion invalida');
    }

    public function update_subscriber(Request $request){
    	$this->validate($request, [
    		'name' => 'required|max:255',
    		'password' => 'required|min:6|confirmed'
    	]);

    	//se busca y actualiza el usuario a traves del token
    	$pending_user = Pending_subscriber::where('token', $request['token'])->first();
    	if($pending_user){
    		$user_update = $pending_user->user;
	    	$user_update->name = $request['name'];
	    	$user_update->password = bcrypt($request['password']);
	    	if($user_update->save()){
	  			$pending_user->delete();
	    		return redirect('login')->with('success', 'Gracias por completar el proceso. Le informaremos una vez su usuario sea dado de alta.');
	    	}
    	}
    	return redirect('login')->with('warning', 'Ocurrio un error');
    }

    public function list_active_user(){
    	$users = User::where([['email', '!=', 'super@super.com'], ['email', '!=', 'admin@admin.com'], ['password', '!=', '']])->get();
    	return view('subscribers.list_active_user')->with('users', $users);
    }

    public function activate_user($id, $state){
        $user = User::where('id', $id)->update(['active' => $state]);
        if($user){
            return response()->json(['response' => 1]);
        }
        return response()->json(['response' => 0]);
    }

    public function delete_user($id){
        $user = User::where('id', $id)->delete();
        if($user){
            return response()->json(['response' => 1]);
        }
        return response()->json(['response' => 0]);
    }
}
