<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;

class AuthenticationController extends Controller
{
    private $client;

    public function __construct(){
        $this->client = Client::find(7);
    }

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

        $params = [
            "grant_type" => "password",
            "client_id" => $this->client->id,
            "client_secret" => $this->client->secret,
            "username" => $request->email,
            "password" => $request->password,
            "scope" => "*"
        ];

        $request->request->add($params);

        $proxy = Request::create('oauth/token', 'POST');

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
    			'resp' => 'Usuário e/ou senha incorreto'
    		], 401);

    	}

    	//A partir daqui está tudo certo com a autenticação
    	$user = auth()->user();

    	//Retorna um objeto e acessa o método, o retorno a string do token para a var token
    	$token = $user->createToken('Token de Acesso')->accessToken;

    	return response()->json([
            'user' => $user,
    		'token' => $token
    	], 200);

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
    	auth()->user()->token()->revoke();

    	return response()->json([
    		'resp' => 'Deslogado com sucesso'
    	], 200);

    }
}
