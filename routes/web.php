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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/items', 'ItemController@index');
Route::post('/items', 'ItemController@store');
Route::get('/items/create', 'ItemController@create');

Route::get('/items/{item}', 'ItemController@show');
Route::delete('/items/{item}', 'ItemController@destroy');
Route::post('/items/{item}/image','Api\ImageUploadController@store')->middleware('auth')->name('image');
Route::get('/items/profile/{item}','ItemProfileController@show');

Route::get('/boxes', 'BoxController@index');
Route::get('/boxes/create', 'BoxController@create');
Route::post('/boxes', 'BoxController@store');
Route::patch('/boxes/{box}', 'BoxController@update');

Route::patch('/boxes/{seller}/{box}','BoxItemController@update');

Route::get('/boxes/{seller}', 'BoxController@index');
Route::get('/boxes/{seller}/{box}','BoxController@show');
Route::get('/boxes/{seller}/{box}/items','BoxItemController@index');
Route::delete('/boxes/{seller}/{box}','BoxController@destroy');
Route::post('/boxes/{seller}/{box}/items','ItemController@store');
Route::delete('/boxes/{seller}/{box}/{item}', 'BoxItemController@destroy');
Route::patch('/boxes/{box}/payment', 'PaymentController@update');

Route::get('/barcode', 'BarcodeController@index');



Route::get('/profiles/{user}','UserProfileController@show')->name('profile');
Route::get('/profiles/{user}/notifications','NotificationController@index');
Route::delete('/profiles/{user}/notifications/{notification}','NotificationController@destroy');

