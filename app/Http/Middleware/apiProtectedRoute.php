<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class apiProtectedRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try{

            $user = JWTAuth::parseToken()->authenticate();

        }catch(\Exception $e){

            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['resp' => 'Token é inválido'], 401);
            }else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['resp' => 'Token expirou'], 401);
            }else{
                 return response()->json(['resp' => 'Token de autorização não foi encontrado'], 401);
            }


        }

        return $next($request);
    }
}
