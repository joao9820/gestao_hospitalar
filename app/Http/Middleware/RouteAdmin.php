<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RouteAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    /*Esse middleware é chamado após o de autenticação portanto se autenticação falhar não chega nele*/
    public function handle($request, Closure $next)
    {

        if (Auth::user()->is_admin) 
            return $next($request);

        //Criar uma view para esse caso
        return response('Acesso restrito aos administradores do sistema');
    
    }
}
