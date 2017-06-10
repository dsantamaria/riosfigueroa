<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Image;
use Storage;
use Gate;

class ImagesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function uploadImage(){
        if (Gate::denies('admin-role')) {
            return redirect()->action('HomeController@index')->with('warning','No estas autorizado');
        }
		return view('Images.uploadImage');
	}

	public function saveImage(Request $request){
        if (Gate::denies('admin-role')) {
            return redirect()->action('HomeController@index')->with('warning','No estas autorizado');
        }

		$this->validate($request, [
            'input-image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $image = $request->file('input-image');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

        $folder_name = 'project_images';
     
        $destinationPath = storage_path('app/'.$folder_name);

        if(!Storage::exists($folder_name)) Storage::makeDirectory($folder_name);

        $img = Image::make($image->getRealPath());
        $img->save($destinationPath.'/'.$input['imagename']);

        return back()->with('success','Image Upload successful');
	}
}