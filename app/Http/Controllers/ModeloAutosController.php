<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Ticket;
use App\MarcaAutos;
use App\ModeloAutos;

class ModeloAutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int  $marca
     * @return \Illuminate\View\View View
     */

    public function index( int $marca )
    {
        $user = Auth::user();
        $marca = MarcaAutos::find($marca);

        if ( $user->es_admin() ) {
            $modelos_propios = ModeloAutos::where('marca_autos_id', $marca->id )->orderBy('nombre','ASC')->get();
            $modelos_ajenos = [];
        } else {
            $modelos_propios = ModeloAutos::where('user_id', $user->id)
                ->where('marca_autos_id', $marca->id )->orderBy('nombre','ASC')->get();
            $modelos_ajenos = ModeloAutos::where('user_id', '!=', $user->id)
                ->where('marca_autos_id',$marca->id )->orderBy('nombre', 'ASC')->get();
        }

        return view('resources.modelos_autos.index')
            ->with('modelos_propios', $modelos_propios)
            ->with('modelos_ajenos', $modelos_ajenos)
            ->with('marca', $marca);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int  $marca
     * @return \Illuminate\View\View View
     */
    public function create( int $marca )
    {
        $marca = MarcaAutos::find($marca);
        $marcas = MarcaAutos::pluck('nombre', 'id');
        return view('resources.modelos_autos.create')->with('marca', $marca)->with('marcas',$marcas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( int $marca, Request $request )
    {
        $modelo = new ModeloAutos( $request->all() );
        $modelo->user_id = Auth::user()->id;
        $modelo->marca_autos_id = $marca;
        $modelo->save();
        flash('Modelo de autos correctamente creado','success');
        return redirect()->route('modelos_de_autos.index', $marca);
    }

    /**
     * Display the specified resource.
     *
     * @param int  $marca
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function show( int $marca, int $id)
    {
        $modelo = ModeloAutos::find($id);
        $marca = MarcaAutos::find($marca);
        return view('resources.modelos_autos.show')->with('marca',$marca)->with('modelo',$modelo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  $marca
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function edit( int $marca, int $id )
    {
        $marcas = MarcaAutos::pluck('nombre', 'id');
        $marca = MarcaAutos::ownerOrAdmin( Auth::user() )->find($marca);
        $modelo = ModeloAutos::find($id);
        return view('resources.modelos_autos.edit')->with('marca', $marca)
            ->with('marcas',$marcas)->with('modelo',$modelo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( int $marca, Request $request, $id)
    {
        $modelo = ModeloAutos::ownerOrAdmin( Auth::user() )->find($id);
        $modelo->fill( $request->all() );
        $modelo->user_id = ( $modelo->user_id ) ? $modelo->user_id : Auth::user()->id;
        $modelo->marca_autos_id = isset( $request->marca_autos_id ) ? $request->marca_autos_id : $marca;
        $modelo->save();
        flash('Modelo de autos correctamente editado','success');
        return redirect()->route('modelos_de_autos.index', $marca);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  $marca
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function delete( int $marca, int $id )
    {
        $modelo = ModeloAutos::find($id);
        $marca = MarcaAutos::find($marca);
        return view('resources.modelos_autos.delete')->with('marca',$marca)->with('modelo',$modelo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $marca
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( int $marca, int $id)
    {
        $modelo = ModeloAutos::find($id);
        $modelo->user_id = 1;
        $modelo->save();
        $ticket = new Ticket();
        $user = Auth::user();
        $ticket->user_id = $user->id;
        $ticket->mensaje = "El usuario '$user->name' <ID: $user->id> intentó eliminar el modelo de autos '$modelo->nombre' <ID: $modelo->id>, marca de autos ID: $marca";
        $ticket->save();
        flash('Se notificó a los administradores del sistema para su futura revisión','info');
        return redirect()->route('modelos_de_autos.index', $marca);
    }

    public function  api_index( int $id_marca )
    {
        $modelos = ModeloAutos::where('marca_autos_id', $id_marca)->select('nombre', 'id')
            ->orderBy('nombre')->get();
        $marca = MarcaAutos::select('nombre', 'id')->find( $id_marca );
        return ['data' => ['modelos' => $modelos, 'marca' => $marca]];
    }
}
