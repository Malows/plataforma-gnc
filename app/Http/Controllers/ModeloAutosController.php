<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\MarcaAutos;
use App\ModeloAutos;

class ModeloAutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View View
     */

    public function index()
    {
        $modelos_propios = ModeloAutos::where('user_id', Auth::user()->id)->orderBy('nombre','ASC')->get();
        $modelos_ajenos = ModeloAutos::where('user_id', '!=', Auth::user()->id)->orderBy('nombre', 'ASC')->get();
        $modelos_propios->each(function($modelos){
          $modelos->marca;
        });
        $modelos_ajenos->each(function($modelos){
            $modelos->marca;
        });
        return view('resources.modelos_autos.index')
            ->with('modelos_propios', $modelos_propios)
            ->with('modelos_ajenos', $modelos_ajenos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View View
     */
    public function create()
    {
        $marcas = MarcaAutos::all();
        return view('resource.modelos_autos.create')->with('marcas', $marcas);
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
        flash('Modelo de autos correctamente creado','success');
        return redirect()->route('modelos_de_autos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function show($id)
    {
        $modelo = ModeloAutos::find($id);
        return view('resources.modelos_autos.show')->with('modelo',$modelo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function edit($id)
    {
        $marcas = MarcaAutos::pluck('nombre', 'id');
        $modelo = ModeloAutos::find($id);
        return view('resources.modelos_autos.edit')->with('marcas',$marcas)->with('modelo',$modelo);
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
        $modelo->user_id = ( $modelo->user_id ) ? $modelo->user_id : Auth::user()->id;
        $modelo->save();
        flash('Modelo de autos correctamente editado','success');
        return redirect()->route('modelos_de_autos.index');
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
        $modelo->user_id = 1;
        $modelo->save();
        flash('Modelo de autos correctamente eliminado','success');
        return redirect()->route('modelos_de_autos.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\View\View View
    */
    public function delete($id)
    {
        $modelo = ModeloAutos::find($id);
        $modelo->marca;
        return view('resources.modelos_autos.delete')->with('modelo',$modelo);
    }


}
