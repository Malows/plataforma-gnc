<?php

namespace App\Http\Controllers;

use App\Mensaje;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('es');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensajes = Mensaje::owner(Auth::user())->get();
        $mensajes->each(function($m){ $m->from;});
        return view('resources.mensajes.index')->with('mensajes',$mensajes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( Auth::user()->es_admin() ){
            $usuarios = User::where('id', '<>', Auth::user()->id )->pluck('name','id');
        } else {
            $usuarios = User::where('tipo_usuario_id', 1)->where('id', '<>', Auth::user()->id )->pluck('name','id');
        }
        return view('resources.mensajes.create')->with('usuarios_disponibles', $usuarios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensaje = new Mensaje( $request->all() );
        $mensaje->from_id = Auth::user()->id;
        $mensaje->to_id = $request->to_id;
        $mensaje->save();
        flash('Mensaje enviado','success');
        return redirect()->route('mensajes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $mensaje = Mensaje::owner(Auth::user())->find($id);
        $mensaje->leido = Carbon::now();
        $mensaje->save();
        $mensaje->from;
        $mensaje->created_at = Carbon::parse($mensaje->created_at);
        return view('resources.mensajes.show')->with('mensaje',$mensaje);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        flash('Intentaste editar un mensaje que ya no se encuentra en tu propiedad. No se pueden editar mensajes enviados', 'danger')->important();
        return redirect()->route('mensajes.index');
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
        flash('Intentaste editar un mensaje que ya no se encuentra en tu propiedad. No se pueden editar mensajes enviados', 'danger')->important();
        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $mensaje = Mensaje::owner(Auth::user())->find($id);
        $mensaje->delete();
        flash('Mensaje eliminado','success');
        return redirect()->route('mensajes.index');
    }

    /**
     * Set the specified message as not readed.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function marcar_no_leido(int $id)
    {
        $mensaje = Mensaje::owner(Auth::user())->find($id);
        $mensaje->leido = null;
        $mensaje->save();
        return redirect()->route('mensajes.index');
    }
}
