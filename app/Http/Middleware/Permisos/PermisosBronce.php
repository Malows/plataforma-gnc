<?php

namespace App\Http\Middleware\Permisos;

use Closure;

class PermisosBronce
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
        if ( $request->user()->tipo_usuario_id > 6 ) {
            abort(403); //not allowed (falta de permisos)
        }
        return $next($request);
    }
}
