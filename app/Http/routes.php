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

Route::group(['middleware' => ['auth', 'country']], function () {
    Route::get('/', 'HomeController@index');
    Route::get('products/import', ['as' => 'lista_precios.import', 'uses' => 'ProductsController@import'])->middleware('admin');
    Route::get('products/search', ['as' => 'products.search', 'uses' => 'ProductsController@searchProducts']);
    Route::get('products/analisis/{analisis}', ['as' => 'products.analisis', 'uses' => 'ProductsController@analisisProducts']);


//Route::post('products', ['as' => 'products.index', 'uses' => 'ProductsController@index']);
    Route::resource('products', 'ProductsController');
//post form import products
    Route::post('/products/process_import', ['as' => 'lista_precios.process', 'uses' => 'ProductsController@processImport'])->middleware('admin');

    Route::resource('proveedores', 'ProveedoresController');
    Route::get('proveedorProducts/{id}', ['as' => 'proveedorProducts', 'uses' => 'ProveedoresController@proveedorProducts']);
    Route::get('productInfo/{id}', ['as' => 'productInfo', 'uses' => 'ProductsController@productInfo']);

    Route::get('uploadImage', ['as'=>'uploadImage', 'uses'=>'ImagesController@uploadImage'])->middleware('admin');
    Route::post('saveImage',['as'=>'saveImage','uses'=>'ImagesController@saveImage'])->middleware('admin');

    Route::get('sendSubscription', ['as'=>'sendSubscription', 'uses'=>'SubscribersController@sendSubscription'])->middleware('admin');
    Route::post('sendSubscriptionEmail', ['as' => 'sendSubscriptionEmail', 'uses' => 'SubscribersController@sendSubscriptionEmail'])->middleware('admin');
    Route::get('listActiveUsers', ['as' => 'listActiveUsers', 'uses' => 'SubscribersController@list_active_user'])->middleware('admin');
    Route::get('activateUser/{id}/{state}', ['as'=>'activateUser', 'uses'=>'SubscribersController@activate_user'])->middleware('admin');
    Route::get('deleteUser/{id}', ['as'=>'deleteUser', 'uses'=>'SubscribersController@delete_user'])->middleware('admin');
    Route::post('updateProducts', ['as' => 'updateProducts', 'uses' => 'ProductsController@updateProducts'])->middleware('admin');;
});

Route::group(['middleware' => ['guest', 'country']], function () {
    Route::get('subscriberForm', ['as'=>'subscriberForm', 'uses'=>'SubscribersController@subscriber_form']);
    Route::post('saveSubscriberForm', ['as'=> 'saveSubscriberForm', 'uses' => 'SubscribersController@saveSubscriberForm']);
    Route::get('registerPending', ['as' => 'registerPending', 'uses' => 'SubscribersController@showRegistrationFormPending']);
    Route::post('update_subscriber', ['as' => 'update_subscriber', 'uses' => 'SubscribersController@update_subscriber']);
});

Route::get('errorCountry', ['as' => 'errorCountry', 'uses' => 'HomeController@errorCountry']);

\DB::connection("mysql")->enableQueryLog();


//Route::get('/home', 'HomeController@index');
//Route::post('/products/success_import', ['as' => 'lista_precios.success']);
