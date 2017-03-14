<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provincia;
use App\Localidad;
//use Illuminate\View\View;

class LocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int $provincia
     * @return \Illuminate\View\View View
     */
    public function index( int $provincia )
    {
        $localidades = Localidad::where('provincia_id', $provincia)->select('id', 'nombre', 'codigo_postal')
            ->orderBy('codigo_postal', 'ASC')->get();

        $provincia = Provincia::find($provincia);
        return view('resources.comun.localidades.index')
            ->with('localidades', $localidades)->with('provincia',$provincia);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $provincia
     * @return \Illuminate\View\View View
     */
    public function create( int $provincia )
    {
        $provincias = Provincia::orderBy('nombre','ASC')->pluck('nombre','id');

        return view('resources.comun.localidades.create')
            ->with('provincias', $provincias)
            ->with('provincia_elegida', $provincia);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $provincia
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $provincia, Request $request)
    {
        $localidad = new Localidad( $request->all() );
        $localidad->provincia_id = $provincia;
        $localidad->save();
        flash('Localidad creada correctamente','success');
        return redirect()->route('localidades.index', ['provincia' => $provincia]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $provincia
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function show( int $provincia, int $id )
    {
        $localidad = Localidad::find($id);
        $provincia = Provincia::find($provincia);
        $localidad->titulares;
        return view('resources.comun.localidades.show')->with('provincia', $provincia)->with('localidad', $localidad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $provincia
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function edit(int $provincia, int $id )
    {
        $localidad = Localidad::find($id);
        $provincia = Provincia::find($provincia);
        $provincias = Provincia::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('resources.comun.localidades.edit')
            ->with('provincia', $provincia)->with('localidad', $localidad)->with('provincias', $provincias);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $provincia
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( int $provincia, Request $request, int $id)
    {
        $localidad = Localidad::find($id);
        $localidad->fill( $request->all() );
        $localidad->provincia_id = $provincia;
        $localidad->save();
        flash('Localidad editada correctamente','success');
        return redirect()->route('localidades.index');
    }

    /**
     * Show a confirmation for deleting the specified resource.
     *
     * @param  int $provincia
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function delete( int $provincia, int $id)
    {
        $localidad = Localidad::find( $id );
        $provincia = Provincia::find( $provincia );
        $localidad->titulares;

        return view('resources.comun.localidades.delete')->with('provincia', $provincia)->with('localidad', $localidad);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $provincia
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $localidad = Localidad::find($id);
        $localidad->delete();
        flash('Localidad eliminada correctamente','success');
        return redirect()->route('localidades.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function api_index($provincia)
    {
        $localidades = Localidad::search($provincia)->select('id', 'nombre', 'codigo_postal')
            ->orderBy('nombre', 'ASC')->get();
        $provincia = Provincia::find($provincia);
        return response()->json(['data' => ['localidades' => $localidades, 'provincia' => $provincia]]);
    }
}
