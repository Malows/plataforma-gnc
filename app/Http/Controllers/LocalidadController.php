<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provincia;
use App\Localidad;

class LocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $localidades = Localidad::search($request)
          ->orderBy('id_provincia', 'DESC')
          ->orderBy('nombre', 'ASC')
          ->paginate(30);

          $localidades->each( function( $localidad ) {
            $localidad->provincia;
          })

          return view('')->with('localidades', $localidades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias = Provincia::orderBy('nombre','ASC')->pluck('nombre','id');

        return view()->with('provincias', $provincias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $localidad = new Localidad( $request->all() );
        $localidad->save();
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
        $localidad = Localidad::find($id);
        return view('')->with('localidad', $localidad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $localidad = Localidad::find($id);
        return view('')->with('localidad', $localidad);
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
        $localidad = Localidad::find($id);
        $localidad->fill( $request->all() );
        $localidad->save();
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
        $localidad = Localidad::find($id);
        $localidad->delete();
        return redirect()->route('');
    }
}
