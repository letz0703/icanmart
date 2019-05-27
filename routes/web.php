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

Route::get('/items/profile/{item}','ItemProfileController@show');
Route::get('/items/{item}', 'ItemController@show');

Route::get('/boxes', 'BoxController@index');
Route::get('/boxes/create', 'BoxController@create');
Route::post('/boxes', 'BoxController@store');
Route::post('/boxes/{seller}/{box}/items','ItemController@store');
Route::get('/boxes/{seller}/{box}', 'BoxController@show');
Route::delete('/boxes/{seller}/{box}', 'BoxController@destroy');
Route::get('/boxes/{seller}', 'BoxController@index');

