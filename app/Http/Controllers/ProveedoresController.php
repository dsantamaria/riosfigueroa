<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedores;
use App\Products;
use App\Http\Requests;

class ProveedoresController extends Controller
{

	public function __construct()
    {
        $this->middleware('saveRoute:proveedores', ['only' => ['index']]);
    }

    public function index()
    {
        $proveedores = Proveedores::All();

        return view('proveedores.index')->withProveedores($proveedores);
    }

    public function proveedorProducts($id){
    	$productos = Products::getProductsProveedor($id);
    	return response()->json(['response' => $productos]);
    }
}