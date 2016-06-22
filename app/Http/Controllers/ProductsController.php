<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Http\Requests;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Products::All();

        return view('products.index')->withProducts($products);
    }

}
