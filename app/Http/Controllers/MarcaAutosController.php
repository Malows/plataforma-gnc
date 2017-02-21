<?php

namespace App\Http\Controllers;

use App\Ticket;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\MarcaAutos;

class MarcaAutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View View
     */
    public function index()
    {
        $user = Auth::user();
        $marcas_propias = MarcaAutos::ownerOrAdmin($user)->orderBy('nombre','ASC')->get();

      if ( $user->es_admin() ) {
          $marcas_ajenas = [];
      } else {
          $marcas_ajenas = MarcaAutos::where('user_id', '!=', $user->id)->orderBy('nombre','ASC');
      }
      return view('resources.marcas_autos.index')->with('marcas_propias', $marcas_propias)->with('marcas_ajenas', $marcas_ajenas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View View
     */
    public function create()
    {
        return view('resources.marcas_autos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $marca = new MarcaAutos( $request->all() );
        $marca->user_id = Auth::user()->id;
        $marca->save();
        flash('Marca de auto creada correctamente', 'success');
        return redirect()->route('marcas_de_autos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( int $id )
    {
        $marca = MarcaAutos::find($id);
        return redirect()->route('modelos_de_autos.index', $marca);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function edit($id)
    {
          $marca = MarcaAutos::ownerOrAdmin( Auth::user() )->find($id);
          return view('resources.marcas_autos.edit')->with('marca', $marca);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, int $id )
    {
          $marca = MarcaAutos::ownerOrAdmin( Auth::user() )->find($id);
          $marca->fill( $request->all() );
          $marca->user_id = ( $marca->id_usuario ) ? $marca->user_id : Auth::user()->id;
          $marca->save();

          return redirect()->route('marcas_de_autos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function delete( int $id )
    {
        $marca = MarcaAutos::find($id);
        $marca->modelos;
        return view('resources.marcas_autos.delete')->with('marca', $marca);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( int $id )
    {
          $marca = MarcaAutos::find($id);
          $marca->user_id = 1;
          $marca->save();
          $ticket = new Ticket();
          $user = Auth::user();
          $ticket->user_id = $user->id;
          $ticket->mensaje = "El usuario '$user->name' <ID: $user->id> intentó eliminar la marca de autos '$marca->nombre' <ID: $marca->id>";
          $ticket->save();
          flash('Se notificó a los administradores del sistema para su futura revisión','info');
          return redirect()->route('marcas_de_autos.index');
    }
}
