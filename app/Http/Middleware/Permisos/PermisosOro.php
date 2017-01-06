<?php

namespace App\Http\Middleware;

use Closure;

class PermisosOro
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
        if ( $request->user()->tipo_usuario <= 4 ) {
            abort(403); //not allowed (falta de permisos)
        }
        return $next($request);
    }
}
