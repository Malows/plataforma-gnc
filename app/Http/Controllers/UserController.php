<?php

namespace App\Http\Controllers;

use App\TipoUsuario;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
    public function create()
    {
        $tipos = TipoUsuario::pluck('nombre', 'id');
        return view('resources.usuarios.create')->with('tipos_de_usuarios', $tipos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User( $request->all() );

        $user->save();
        return redirect()->route('user.index');
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
        return view('resources.usuarios.edit')->with('usuario',$usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $usuario = User::find( $id );
        $usuario->fill( $request->all() );
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $usuario = User::find( $id );
        $usuario->delete();
        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
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
