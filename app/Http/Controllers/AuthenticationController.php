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
            return response()->json($validator->errors(), 400);
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

        $credentials = $request->only(['email', 'password']);

    	$validator = Validator::make($credentials, [
    		'email' => 'required|string|email',
    		'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //Corrigir a frase
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['resp' => 'Usuário e/ou senha incorreto'], 401);
        }

        return $this->respondWithToken($token);

    }

     /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'user' => auth('api')->user(),
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function registerWeb(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if(!$user->save()){

            return response()->json([
            'resp' => 'Não foi possível realizar o cadastro do usuário', 
            ], 400);

        }

        return response()->json([
            'resp' => 'Usuário criado com sucesso!', 
        ], 201);
        
    }

    public function loginWeb(Request $request){

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
                'resp' => 'Usuário e/ou senha incorreto'
            ], 401);

        }

        return response()->json([
            'resp' => 'OK'
        ], 200);

    }

    public function logout(Request $request){
    	//Revoga o Token gerado
    	auth('api')->logout();

        // Pass true to force the token to be blacklisted "forever"
        //auth()->logout(true);

    	return response()->json([
    		'resp' => 'Deslogado com sucesso'
    	], 200);

    }
}
