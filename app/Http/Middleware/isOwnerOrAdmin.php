<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class isOwnerOrAdmin
{
    /**
     * Como se usa este middleware:
     *  Supongo que estoy en algun recurso, como `clientes`
     *  el middleware se llama con el nombre 'isOwnerOrAdmin:clientes'
     *  Donde `clientes` es el nombre de la base de datos!!!!!!
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $recurso)
    {
        $usuario_autorizado = DB::table($recurso)->find( $request->id )->id_usuario;
        $es_owner = $request->user()->id == $usuario_autorizado;
        $es_admin = $request->user()->id_tipo_usuario == 1;
        if ( ! $es_owner or ! $es_admin ){
            abort(401); //unauthorized
        }
        return $next($request);
    }
}
