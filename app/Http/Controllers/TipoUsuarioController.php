<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoUsuario;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View View
     */
    public function index()
    {
        $tipos = TipoUsuario::orderBy('id','ASC')->get();
        return view('resources.tipos_usuarios.index')->with('tipos_usuarios',$tipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View View
     */
    public function create()
    {
        return view('resources.tipos_usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = new TipoUsuario( $request->all() );
        $tipo->save();
        flash('Tipo de usuario creado correctamente','success');
        return redirect()->route('tipo_de_usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = TipoUsuario::find($id);
        flash('No hay más información del tipo "'.$tipo->nombre.'" que la que se ve en el índice', 'info');
        return redirect()->route('tipo_de_usuarios.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function edit($id)
    {
        $tipo = TipoUsuario::find($id);
        return view('resources.tipos_usuarios.edit')->with('tipo_usuario',$tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipo = TipoUsuario::find($id);
        $tipo->fill( $request-all() );
        flash('Tipo de usuario editado correctamente','success');
        return redirect()->route('tipo_de_usuarios.index');
    }

    /**
     * Show a confirmation for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function delete(int $id)
    {
        $tipo = TipoUsuario::find( $id );
        return view('resources.tipos_usuarios.delete')->with('tipo_usuario', $tipo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = TipoUsuario::find($id);
        flash('No se puede eliminar '. $tipo->nombre.' desde la plataforma web. Probá conectandote al servidor de base de datos','info');
        return redirect()->route('tipo_de_usuarios.index');
    }
}
