<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Toda parte de autenticação fica atrás de /api/auth, nessa classe tudo já está em api
//Agrupamos tudo que está em auth
Route::prefix('auth')->group(function(){

	Route::post('registro', 'AuthenticationController@register');
	Route::post('login', 'AuthenticationController@login');

	//Só pode acessar se já tiver logado
	Route::middleware('apiJWT')->group(function(){
		Route::post('logout', 'AuthenticationController@logout');
	});

});

//Admin
Route::group(['middleware' => ['apiJWT', 'adminApi']], function(){

	Route::delete('usuarios/{id}', 'UserController@destroy');
	//O usuário pode ver os dados dele na rota show
	Route::get('usuarios', 'UserController@index');

});

//Usuários
Route::group(['middleware' => ['apiJWT']], function(){

	Route::put('usuarios/{id}', 'UserController@update');

    Route::get('usuarios/{id}', 'UserController@show');

	//fica fora do /auth. Só /api/unidades
	Route::get('unidades', 'UnidadesController@index');

});



