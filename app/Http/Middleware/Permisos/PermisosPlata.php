<?php

namespace App\Http\Middleware\Permisos;

use Closure;

class PermisosPlata
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
        if ( $request->user()->id_tipo_usuario > 5 ) {
            abort(403); //not allowed (falta de permisos)
        }
        return $next($request);
    }
}
