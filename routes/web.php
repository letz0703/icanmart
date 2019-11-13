<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

App::setLocale('kr');

Route::get('/', function (){
    return view('welcome');
});

Route::get('/icanmart', function (){
    return view('icanmart');
});

Route::get('/tasks', 'TaskController@index');
Route::post('/tasks', 'TaskController@store');

Route::get('/icanmart-inline', function(){
    return view('icanmart-inline');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/items', 'ItemController@index');
Route::post('/items', 'ItemAddController@store');
Route::get('/items/create', 'ItemController@create');

Route::get('/items/search', 'SearchController@show');
Route::get('/items/{item}', 'ItemController@show');
Route::delete('/items/{item}', 'ItemController@destroy');
Route::post('/items/{item}/image', 'Api\ImageUploadController@store')->middleware('auth')->name('image');
Route::get('/items/profile/{item}', 'ItemProfileController@show');

Route::get('/boxes', 'BoxController@index')->name('boxes');
Route::get('/boxes/create', 'BoxController@create');
Route::post('/boxes', 'BoxController@store');
Route::patch('/boxes/{box}', 'BoxController@update');
Route::patch('/boxes/{seller}/{box}', 'BoxItemController@update')
     ->name('boxes.update');

Route::get('/boxes/{seller}', 'BoxController@index');
Route::get('/boxes/{seller}/{box}', 'BoxController@show');
Route::get('/boxes/{seller}/{box}/items', 'BoxItemController@index');
Route::delete('/boxes/{seller}/{box}', 'BoxController@destroy');

Route::post('/boxes/{seller}/{box}/items', 'ItemController@store')
     ->name('item.box.store');

Route::delete('/boxes/{seller}/{box}/{item}', 'BoxItemController@destroy');
Route::patch('/boxes/{box}/payment', 'PaymentController@update');

// Locked Box
Route::post('/locked-boxes/{thread}', 'LockedBoxController@store')
     ->name('locked-box.store')->middleware('admin');
Route::delete('/locked-boxes/{box}', 'LockedBoxController@destroy')
     ->name('locked-box.destroy')->middleware('admin');


Route::get('/barcode', 'BarcodeController@index');
Route::get('/profiles/{user}', 'UserProfileController@show')->name('profile');
Route::get('/profiles/{user}/notifications', 'NotificationController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'NotificationController@destroy');
Route::group([
    'prefix'     => 'admin',
    'middleware' => 'admin',
    'namespace'  => 'Admin',
], function (){
    Route::get('', 'DashboardController@index')->name('admin.dashboard.index');
    Route::post('sellers', 'SellerController@store')->name('admin.sellers.store');
    Route::get('sellers', 'SellerController@index')->name('admin.sellers.index');
    Route::get('sellers/create', 'SellerController@create')->name('admin.sellers.create');
    Route::get('/sellers/{seller}/edit', 'SellerController@edit')
         ->name('admin.sellers.edit');
    Route::patch('/sellers/{seller}', 'SellerController@update')
         ->name('admin.sellers.update');
    
});



