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

Route::get('login_teste', 'LoginController@index')->name('login_teste');
Route::get('unidades', 'UnidadesController@indexView')->name('unidades');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('login_teste', 'AuthenticationController@loginWeb')->name('login_teste');

Route::get('register_web', 'LoginController@register')->name('register_web');
Route::post('register_teste', 'AuthenticationController@registerWeb')->name('register_teste');
