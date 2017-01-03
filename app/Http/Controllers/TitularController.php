<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Titular;
use App\Vehiculo;

class TitularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $titulares = ( $user->tipo_usuario === 1 ) ?
          Titular::all() : Titular::where('id_usuario', $user->id) ;
        $titulares->sortBy('apellido')->sortBy('nombre')->paginate(20);
        return view('')->with('titulares',$titulares);
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
        $titular = new Titular( $request->all() );
        $titular->id_usuario = Auth::user()->id;
        $titular->save();
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
        $titular = Titular::find($id);
        $titular->vehiculos;
        $titular->localidad;
        return view('')->with('titular',$titular);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $vehiculos = ( $user->tipo_usuario === 1 ) ?
          Vehiculo::all() : Vehiculo::where('id_usuario', $user->id) ;

        $titular = Titular::find($id);
        $titular->vehiculos;
        return view('')->with('titular',$titular)->with('vehiculos',$vehiculos);
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
        $titular = Titular::find($id);
        $titular->fill( $request->all() );

        $titular->id_usuario = ( $titular->id_usuario ) ?
          $titular->id_usuario : Auth::user()->id;
        $titular->save();
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
        $titular = Titular::find($id);
        $titular->delete();
        return redirect()->route('');
    }
}
