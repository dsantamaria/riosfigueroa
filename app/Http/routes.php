<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('products/import', ['as' => 'lista_precios.import', 'uses' => 'ProductsController@import']);
    Route::get('products/search', ['as' => 'products.search', 'uses' => 'ProductsController@searchProducts']);
//Route::post('products', ['as' => 'products.index', 'uses' => 'ProductsController@index']);
    Route::resource('products', 'ProductsController');
//post form import products
    Route::post('/products/process_import', ['as' => 'lista_precios.process', 'uses' => 'ProductsController@processImport']);

    Route::resource('proveedores', 'ProveedoresController');
    Route::get('proveedorProducts/{id}', ['as' => 'proveedorProducts', 'uses' => 'ProveedoresController@proveedorProducts']);
    Route::get('productInfo/{id}', ['as' => 'productInfo', 'uses' => 'ProductsController@productInfo']);

    Route::get('uploadImage', ['as'=>'uploadImage', 'uses'=>'ImagesController@uploadImage']);
    Route::post('saveImage',['as'=>'saveImage','uses'=>'ImagesController@saveImage']);

});
\DB::connection("mysql")->enableQueryLog();


//Route::get('/home', 'HomeController@index');
//Route::post('/products/success_import', ['as' => 'lista_precios.success']);
