<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedores;
use App\Http\Requests;

class ProveedoresController extends Controller
{
    public function index()
    {
        $proveedores = Proveedores::All();

        return view('proveedores.index')->withProveedores($proveedores);
    }
}
