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

Route::group(['middleware' => ['auth']], function () {
    //************************* ProductsController ******************//
    Route::get('/', 'HomeController@index')->middleware('country');
    Route::get('products/import', ['as' => 'lista_precios.import', 'uses' => 'ProductsController@import'])->middleware('admin');
    Route::get('products/search', ['as' => 'products.search', 'uses' => 'ProductsController@searchProducts'])->middleware('saveRoute:buscar_productos');
    Route::get('products/analisis/{analisis}', ['as' => 'products.analisis', 'uses' => 'ProductsController@analisisProducts']);
    Route::get('products/import_products_analysis_category', ['as' => 'import_products_analysis_category', 'uses' => 'ProductsController@importProductsAnalysisCategory'])->middleware('admin');
    Route::get('products/import_analysis_historic_lists', ['as' => 'import_analysis_historic_lists', 'uses' => 'ProductsController@importAnalysisHistoricLists'])->middleware('admin');

    Route::resource('products', 'ProductsController');
    Route::get('productInfo/{id}', ['as' => 'productInfo', 'uses' => 'ProductsController@productInfo']);
    Route::get('analisisPrecios', ['as'=>'analisisPrecios', 'uses'=>'ProductsController@analisisPrecios']);
    Route::get('analisisHistorico', ['as'=>'analisisHistorico', 'uses'=>'ProductsController@analisisHistorico']);
    Route::get('gestionListasAnalisisPrecios', ['as'=>'gestionListasAnalisisPrecios', 'uses'=>'ProductsController@gestionListasAnalisisPrecios'])->middleware('admin');
    Route::get('gestionListasAnalisisHistoricos', ['as'=>'gestionListasAnalisisHistoricos', 'uses'=>'ProductsController@gestionListasAnalisisHistoricos'])->middleware('admin');
    Route::get('deleteListCategory/{id}', ['as'=>'deleteListCategory', 'uses'=>'ProductsController@deleteListCategory'])->middleware('admin');
    Route::get('deleteListHistoric/{ingrediente_id}/{year}', ['as'=>'deleteListHistoric', 'uses'=>'ProductsController@deleteListHistoric'])->middleware('admin');
    
    //post form import products
    Route::post('/products/process_import', ['as' => 'lista_precios.process', 'uses' => 'ProductsController@processImport'])->middleware('admin');
    Route::post('/products/process_import_products_analysis_category', ['as' => 'process_import_products_analysis_category', 'uses' => 'ProductsController@processImportProductsAnalysisCategory'])->middleware('admin');
    Route::post('/products/process_import_analysis_historic_list', ['as' => 'process_import_analysis_historic_list', 'uses' => 'ProductsController@processImportAnalysisHistoricList'])->middleware('admin');
    Route::post('updateProducts', ['as' => 'updateProducts', 'uses' => 'ProductsController@updateProducts'])->middleware('admin');
    

    //************************* ProveedoresController ******************//
    Route::resource('proveedores', 'ProveedoresController');
    Route::get('proveedorProducts/{id}', ['as' => 'proveedorProducts', 'uses' => 'ProveedoresController@proveedorProducts']);
    

    //************************* ImagesController ******************//
    Route::get('uploadImage', ['as'=>'uploadImage', 'uses'=>'ImagesController@uploadImage'])->middleware('admin');
    Route::get('deleteImage/{id}', ['as'=>'deleteImage', 'uses'=>'ImagesController@delete_image'])->middleware('admin');
    Route::post('saveImage',['as'=>'saveImage','uses'=>'ImagesController@saveImage'])->middleware('admin');


    //************************* SubscriberController ******************//
    Route::get('sendSubscription', ['as'=>'sendSubscription', 'uses'=>'SubscribersController@sendSubscription'])->middleware('admin');
    Route::get('listActiveUsers', ['as' => 'listActiveUsers', 'uses' => 'SubscribersController@list_active_user'])->middleware('admin');
    Route::get('activateUser/{id}/{state}', ['as'=>'activateUser', 'uses'=>'SubscribersController@activate_user'])->middleware('admin');
    Route::get('globalAccessUser/{id}/{state}', ['as'=>'globalAccessUser', 'uses'=>'SubscribersController@global_access_user'])->middleware('admin');
    Route::get('deleteUser/{id}', ['as'=>'deleteUser', 'uses'=>'SubscribersController@delete_user'])->middleware('admin');
    Route::post('sendSubscriptionEmail', ['as' => 'sendSubscriptionEmail', 'uses' => 'SubscribersController@sendSubscriptionEmail'])->middleware('admin');
    
    
    //************************* GraphicsController ******************//
    Route::get('updateAnalysisPrice/{category_id}/{analisis_especifico}/{tipo_analisis}/{producto_ingrediente}/{compania}/{tiempo}/{producto_ingrediente2}/{compania2}', ['as' => 'updateAnalysisPrice', 'uses' => 'GraphicsController@updateAnalysisPrice'])->middleware('saveRoute:precios');
    Route::get('updateAnalysisHistoric/{id}/{year}', ['as' => 'updateAnalysisHistoric', 'uses' => 'GraphicsController@updateAnalysisHistoric'])->middleware('saveRoute:importaciones');
    Route::get('getProducts/{category_name}/{company_id}', ['as' => 'getProducts', 'uses' => 'GraphicsController@getProducts']);
    Route::get('getIngredientsForCuartiles/{category_name}/{company_id}', ['as' => 'getIngredientsForCuartiles', 'uses' => 'GraphicsController@getIngredientsForCuartiles']);
    Route::get('getIngredientes/{categoria_id}', ['as' => 'getIngredientes', 'uses' => 'GraphicsController@getIngredientes']);
    Route::get('getYears/{ingrediente_id}', ['as' => 'getYears', 'uses' => 'GraphicsController@getYears']);

    //************************* HomeController *********************//
    Route::post('SaveCustomNotes', ['as' => 'SaveCustomNotes', 'uses' => 'HomeController@SaveCustomNotes']);


    //************************* MarketValueController *********************//
    Route::get('market_value', ['as' => 'market_value', 'uses' => 'MarketValueController@market_value'])->middleware('admin');
    Route::post('market_import', ['as' => 'market_import', 'uses' => 'MarketValueController@market_import'])->middleware('admin');

    //************************* UserActivityController *********************//
    Route::get('user_activity/index', ['as' => 'user_activity.index', 'uses' => 'UserActivityController@index'])->middleware('admin');
    Route::get('user_activity/userInfo/{id}', ['as' => 'user_activity.userInfo', 'uses' => 'UserActivityController@userInfo'])->middleware('admin');
    Route::get('getDateInfo/{id}', ['as' => 'getDateInfo', 'uses' => 'UserActivityController@getDateInfo'])->middleware('admin');
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('subscriberForm', ['as'=>'subscriberForm', 'uses'=>'SubscribersController@subscriber_form']);
    Route::post('saveSubscriberForm', ['as'=> 'saveSubscriberForm', 'uses' => 'SubscribersController@saveSubscriberForm']);
    Route::get('registerPending', ['as' => 'registerPending', 'uses' => 'SubscribersController@showRegistrationFormPending']);
    Route::post('update_subscriber', ['as' => 'update_subscriber', 'uses' => 'SubscribersController@update_subscriber']);
});

Route::get('errorCountry', ['as' => 'errorCountry', 'uses' => 'HomeController@errorCountry']);
Route::get('updateTimer', ['as' => 'updateTimer', 'uses' => 'UserActivityController@updateTimer']);


\DB::connection("mysql")->enableQueryLog();


//Route::get('/home', 'HomeController@index');
//Route::post('/products/success_import', ['as' => 'lista_precios.success']);
