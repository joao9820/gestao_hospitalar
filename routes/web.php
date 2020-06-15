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

//Route::get('login_teste', 'LoginController@index')->name('login_teste');
Route::get('unidades', 'UnidadesController@indexView')->name('unidades');

Route::group(['middleware' => 'auth'], function(){

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/unidades', 'Web\UnidadesController@index')->name('unidades');

	Route::get('/unidades/medicamentos', 'Web\UnidadesMedicamentosController@index')->name('unidades_medicamentos');

});

Route::group(['middleware' => ['auth', 'admin']], function(){

	Route::get('/usuarios', 'Web\UsuariosController@index')->name('usuarios');
	Route::get('/usuarios/apagar/{id}', 'Web\UsuariosController@destroy')->name('usuario_apagar');

	Route::prefix('api-web')->group(function(){

		Route::put('/usuarios/{id}', 'UserController@update')->name('usuario_atualizar');
		Route::post('/usuarios', 'AuthenticationController@register')->name('usuario_cadastrar');
		Route::get('/usuarios/{id}', 'UserController@show')->name('listar_usuario');
		Route::delete('/usuarios/{id}', 'UserController@destroy')->name('usuario_apagar');							
	});

});


//Route::post('login_teste', 'AuthenticationController@loginWeb')->name('login_teste');

//Route::get('register_web', 'LoginController@register')->name('register_web');
//Route::post('register_teste', 'AuthenticationController@registerWeb')->name('register_teste');
