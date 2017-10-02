<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Image;
use File;
use Gate;
use App\Categorias;
use App\Analysis_category_image;

class ImagesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function uploadImage(){
        $categorias  = Categorias::whereIn('nombre_categoria', ['Insecticida', 'Herbicida', 'Fungicida'])->pluck('nombre_categoria', 'id');
		return view('Images.uploadImage')->with('categorias', $categorias);
	}

	public function saveImage(Request $request){
		$this->validate($request, [
          'input-image' => 'required|image|max:8192',
        ]);

        $image = $request->file('input-image');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

        $categoria_id = $request['categorias'];
        $categoria = Categorias::where('id', $categoria_id)->first();

        $folder_name = 'project_images/'.$categoria['nombre_categoria'];
     
        $destinationPath = public_path($folder_name);

        if(!File::exists($folder_name)) {
            if(!File::exists('project_images')) File::makeDirectory('project_images');
            File::makeDirectory($folder_name);
        }
        
        $img = Image::make($image->getRealPath());

        $img->save($destinationPath.'/'.$input['imagename']);

        $save_image_db = new Analysis_category_image;
        $save_image_db->categoria_id = $request['categorias'];
        $save_image_db->path = '/project_images/'.$categoria['nombre_categoria'].'/'.$input['imagename'];
        $save_image_db->title = $request['title'];
        $save_image_db->description = $request['description'];
        $save_image_db->save();

        return back()->with('success','Image Upload successful');
	}
}