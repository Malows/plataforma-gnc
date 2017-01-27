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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\View\View View
     */
    public function index(Request $request)
    {
        $localidades = null;
        if ( !isset( $request->provincia ) or $request->provincia === 0 ){
            $localidades = Localidad::orderBy('provincia_id', 'ASC')->orderBy('nombre', 'ASC')->paginate(15);
        } else {
            $localidades = Localidad::search($request->provincia)->orderBy('codigo_postal', 'ASC')->paginate(15);
        }

        $localidades->each( function( $localidad ) {
            $localidad->provincia;
        });

        $provincias = Provincia::pluck('nombre','id');
        $provincias->prepend('Todas las provincias', 0);


        $vista = view('resources.localidades.index')->with('localidades', $localidades)->with('provincias',$provincias);
        if ( isset( $request->provincia ) and $request->provincia !== 0 ){
            $vista->with('provincia_filtro', $request->provincia);
        }
        return $vista;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View View
     */
    public function create()
    {
        $provincias = Provincia::orderBy('nombre','ASC')->pluck('nombre','id');

        return view('resources.localidades.create')->with('provincias', $provincias);
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
        flash('Localidad creada correctamente','success');
        return redirect()->route('localidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function show($id)
    {
        $localidad = Localidad::find($id);
        $localidad->provincia;
        $localidad->titulares;
        return view('resources.localidades.show')->with('localidad', $localidad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function edit($id)
    {
        $localidad = Localidad::find($id);
        $provincias = Provincia::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('resources.localidades.edit')->with('localidad', $localidad)->with('provincias', $provincias);
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
        flash('Localidad editada correctamente','success');
        return redirect()->route('localidades.index');
    }

    /**
     * Show a confirmation for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function delete(int $id)
    {
        $localidad = Localidad::find( $id );
        $localidad->provincia;
        $localidad->titulares;

        return view('resources.localidades.delete')->with('localidad', $localidad);
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
        flash('Localidad eliminada correctamente','success');
        return redirect()->route('localidades.index');
    }
}
