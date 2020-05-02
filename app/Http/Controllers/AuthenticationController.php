<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(Request $request){

    	$validator = Validator::make($request->all(), [
            'username' => 'required|string|min:6',
    		'email' => 'required|string|email|unique:users',
    		'password' => 'required|string|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['resp' => $validator->errors()->first()], 400);
        }

    	$user = new User([
    		'name' => $request->username,
    		'email' => $request->email,
    		'password' => bcrypt($request->password)
    	]);

    	$user->save();

    	return response()->json([
    		'resp' => 'Usuário criado com sucesso!', 
    	], 201);

    }

    public function login(Request $request){

    	$validator = Validator::make($request->all(), [
    		'email' => 'required|string|email',
    		'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

    	$credentials = [
    		'email' => $request->email,
    		'password' => $request->password,
    	];

    	//retorna TRUE
    	if(!Auth::attempt($credentials)){

    		return response()->json([
    			'resp' => 'Acesso negado'
    		], 401);

    	}

    	//A partir daqui está tudo certo com a autenticação
    	$user = auth()->user();

    	//Retorna um objeto e acessa o método, o retorno a string do token para a var token
    	$token = $user->createToken('Token de Acesso')->accessToken;

    	return response()->json([
    		'token' => $token
    	], 200);

    }

    public function logout(Request $request){
    	//Revoga o Token gerado
    	auth()->user()->token()->revoke();

    	return response()->json([
    		'resp' => 'Deslogado com sucesso'
    	], 200);

    }
}
