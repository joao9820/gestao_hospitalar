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

Route::put('usuarios/{id}', 'Usercontroller@update');

//fica fora do /auth. Só /api/unidades
Route::get('unidades', 'UnidadesController@index');

//Apenas para teste, depois incluir no grupo JWT
Route::get('usuarios', 'UserController@index');
