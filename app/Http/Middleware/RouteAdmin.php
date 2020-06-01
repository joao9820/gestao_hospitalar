<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

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

        if (User::isAdmin()) 
            return $next($request);

        //Criar uma view para esse caso
        return response('Acesso não autorizado');
    
    }
}
