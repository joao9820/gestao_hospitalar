<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RouteAdminApi
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
        if(Auth::user()->is_admin) return $next($request);

        return response()->json(['error'=>__('messages.restricted_access_to_admin')], 401);
    }
}
