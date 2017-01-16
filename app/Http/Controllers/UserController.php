<?php

namespace App\Http\Controllers;

use App\TipoUsuario;
use App\User;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Contracts\Routing\ResponseFactory;

class UserController extends Controller
{
    function __construct()
    {
        Carbon::setLocale('es');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View View
     */
    public function index()
    {
        $users = User::paginate(20);
        $users->each(function ($users){
            $users->tipo_usuario;
            $users->inicio = Carbon::parse($users->fecha_de_licencia);
            $users->fin = ($users->tipo_usuario_id === 1) ?
                Carbon::maxValue() :
                Carbon::parse($users->fecha_de_licencia)->addDays($users->duracion_de_licencia);
            $users->diferencia = Carbon::now()->diffForHumans($users->fin);
        });
        return view('resources.usuarios.index')->with('usuarios',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View View
     */
    public function create() : View
    {
        $tipos = TipoUsuario::pluck('nombre', 'id');
        return view('resources.usuarios.create')->with('tipos_de_usuarios', $tipos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User( $request->all() );
        $user->password = bcrypt( $user->password );
        $user->habilitado = intval( $user->habilidato );
        $user->duracion_de_licencia = intval( $user->duracion_de_licencia );
        $user->save();
        flash('Usuario '. $user->name .' registrado correctamente','success');
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function show(int $id)
    {
        $usuario = User::find( $id );
        $usuario->tipo_usuario;
        if ( $usuario->tipo_usuario_id != 1) {
            $usuario->titulares;
            $usuario->titulares->each(function ($titulares){
                $titulares->vehiculos;
            });

            $usuario->marcas_de_autos_registradas;

            $usuario->modelos_de_autos_registrados;
            $usuario->modelos_de_autos_registrados->each(function ($modelo){
                $modelo->marca;
            });
        }
        $usuario->inicio = Carbon::parse($usuario->fecha_de_licencia);
        $usuario->fin = ($usuario->tipo_usuario_id === 1) ?
            Carbon::maxValue() :
            Carbon::parse($usuario->fecha_de_licencia)->addDays($usuario->duracion_de_licencia);
        $usuario->diferencia = Carbon::now()->diffForHumans($usuario->fin);
        return view('resources.usuarios.show')->with('usuario',$usuario);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function edit(int $id)
    {
        $usuario = User::find( $id );
        $usuario->tipo_usuario;
        $tipos = TipoUsuario::pluck('nombre', 'id');
        return view('resources.usuarios.edit')->with('usuario',$usuario)->with('tipos_de_usuarios', $tipos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, int $id)
    {
        $usuario = User::find( $id );
        $usuario->fill( $request->all() );

//        $usuario->fecha_de_licencia = Carbon::now();

        $usuario->save();
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $expropiado = User::find( $id );

        $func = function ($elem) {
            $elem->user_id = Auth::user()->id;
            $elem->save();
        };

        $expropiado->titulares->each($func);
        $expropiado->vehiculos->each($func);
        $expropiado->marcas_de_autos_registradas->each($func);
        $expropiado->modelos_de_autos_registrados->each($func);

        $usuario = User::find($expropiado->id);
        $a = $usuario->titulares->count();
        $b = $usuario->vehiculos->count();
        $c = $usuario->marcas_de_autos_registradas->count();
        $d = $usuario->modelos_de_autos_registrados->count();

        if( $a == 0 and $b == 0 and $c == 0 and $d == 0 ) {
            $usuario->delete();
            flash('Usuario ' . $usuario->name . ' correctamente eliminado' ,'info');
        } else {
            flash('Algo inesperado ocurrió intentando eliminar al usuario ' . $usuario->name,'danger');
        }
        return redirect()->route('usuarios.index');
    }

    /**
     * Show a confirmation for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function delete(int $id)
    {
        $usuario = User::find( $id );
        $usuario->tipo_usuario;
        $usuario->titulares;
        $usuario->marcas_de_autos_registradas;
        $usuario->modelos_de_autos_registrados;

        return view('resources.usuarios.delete')->with('usuario', $usuario);
    }
}
