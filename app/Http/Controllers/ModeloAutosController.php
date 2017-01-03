<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MarcaAutos;
use App\ModeloAutos;

class ModeloAutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // TODO: scope para filtrar
        $user = Auth::user();
        $modelos_de_usuario = ModeloAutos::where('id_usuario', $user->id)
          ->sortBy('nombre');
        $modelos_de_otros = ModeloAutos::where('id_usuario', '!=', $user->id)
          ->sortBy('nombre');
        $modelos = $modelos_de_usuario->union($modelos_de_otros);
        $modelos->paginate(30);
        $modelos->each(function($modelos){
          $modelos->marca;
        });
        return view('')->with('modelos', $modelos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = MarcaAutos::all();
        return view('')->with('marcas', $marcas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modelo = new ModeloAutos( $request->all() );
        $modelo->id_usuario = Auth::user()->id;
        $modelo->save();
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
        $modelo = ModeloAutos::find($id);
        return view('')->with('modelo',$modelo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marcas = MarcaAutos::all();
        $modelo = ModeloAutos::find($id);
        return view('')
          ->with('marcas',$marcas)
          ->with('modelo',$modelo);
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
        $modelo = ModeloAutos::find($id);
        $modelo->fill( $request->all() );
        $modelo->id_usuario = ( $modelo->id_usuario ) ?
          $modelo->id_usuario : Auth::user()->id;
        $modelo->save();
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
      $modelo = ModeloAutos::find($id);
      $modelo->delete();
      return redirect()->route('');
    }
}
