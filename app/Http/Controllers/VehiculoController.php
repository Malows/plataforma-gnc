<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Vehiculo;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $vehiculos = ( $user->tipo_usuario == 1 ) ?
          Vehiculo::all() : Vehiculo::where('id_usuario', $user->id_usuario);
        $vehiculos->sortBy('update_at')->paginate(20);
        $vehiculos->each(function($vehiculo){
          $vehiculo->titular;
          $vehiculo->marca;
          $vehiculo->modelo;
        });
        return view('')->with('vehiculos',$vehiculos);
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
        $vehiculo = new Vehiculo( $request->all() );
        $vehiculo->id_usuario = Auth::user()->id;
        $vehiculo->save();
        return redirect()->route('vehiculos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehiculo = Vehiculo::find($id);
        $vehiculo->marca;
        $vehiculo->modelo;
        $vehiculo->titular;
        return view('')->with('vehiculo',$vehiculo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::find($id);
        $vehiculo->marca;
        $vehiculo->modelo;
        $vehiculo->titular;
        return view('')->with('vehiculo',$vehiculo);
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
        $vehiculo = Vehiculo::find($id);
        $vehiculo->fill( $request->all() );
        $vehiculo->id_usuario = ( $vehiculo->id_usuario ) ?
          $vehiculo->id_usuario : Auth::user()->id;
        $vehiculo->save();
        return redirect()->route('vehiculos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehiculo = Vehiculo::find($id);
        $vehiculo->delete();
        return redirect()->route('vehiculos.index');
    }
}
