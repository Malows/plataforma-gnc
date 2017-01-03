<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MarcaAutos;

class MarcaAutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $marcas_registradas_por_usuario = MarcaAutos::where('id_usuario', $user->id)
        ->sortBy('nombre');
      $marcas_de_otros_usuarios = MarcaAutos::where('id_usuario', '!=', $user->id)
        ->sortBy('nombre');
      $marcas = $marcas_registradas_por_usuario->union( $marcas_de_otros_usuarios);
      $marcas->paginate(30);
      return view('')->with('marcas', $marcas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marca = new MarcaAutos( $request->all() );
        $marca->id_usuario = Auth::user()->id;
        $marca->save();
        return redirect()->route('');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = MarcaAutos::find($id);
        return view('')->with('marca', $marca);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $marca = MarcaAutos::find($id);
          return view('')->with('marca', $marca);
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
          $marca = MarcaAutos::find($id);
          $marca->fill( $request->all() );
          $marca->id_usuario = ( $marca->id_usuario ) ?
            $marca->id_usuario : Auth::user()->id;
          $marca->save();
          return redirect()->route('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $marca = MarcaAutos::find($id);
          $marca->delete();
          return redirect()->route('');
    }
}
