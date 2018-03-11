<?php

namespace App\Http\Controllers;

use Mail;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Custom_note;
use Log;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['errorCountry']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $data_html = Custom_note::where('position', 1)->get();
        $data = $data_html->isEmpty() ? 'You are logged in' : $data_html[0]->data_html;
        return view('home')->with('custom_notes', $data);
    }

    public function errorCountry(){
        if(Auth::check()) Auth::logout();
        return view('errors.403_6')->with('warning', 'wrong country');
    }

    public function SaveCustomNotes(Request $request){
        $data_html = Custom_note::where('position', 1)->get();
        if($data_html->isEmpty()){
            Custom_note::create(['position' => 1, 'data_html' => $request['custom_notes']]);
        }else{
            Custom_note::where('position', 1)->update(['data_html' => $request['custom_notes']]);
        }
        return redirect('/')->with('custom_notes', $request['custom_notes']);
    }
}
