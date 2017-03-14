<?php

namespace App\Http\Controllers;

use App\ServicioDeTaller;
use App\Titular;
use App\TrabajoDeTaller;
use App\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrabajoDeTallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabajos = TrabajoDeTaller::ownerOrAdmin( Auth::user() )->orderBy('created_at','DESC')->paginate(20);
        $servicios = ServicioDeTaller::pluck('nombre','id');
        return view('resources.trabajos_de_taller.index',['trabajos' => $trabajos, 'servicios' => $servicios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titulares = Titular::ownerOrAdmin( Auth::user() )->select('nombre', 'apellido', 'id')
            ->orderBy('apellido')->orderBy('nombre')->get();
        $titulares->each( function ($t){
            $t->full_name = $t->apellido . ', ' . $t->nombre;
            unset( $t->nombre );
            unset( $t->apellido );
        });
        $aux = array_pluck($titulares->toArray(), 'full_name', 'id');

        $servicios = ServicioDeTaller::pluck('nombre','id');
        return view('resources.trabajos_de_taller.create', ['servicios' => $servicios, 'titulares' => $aux]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trabajo = new TrabajoDeTaller( $request->all() );
        $trabajo->user_id = Auth::user()->id;
        if ( $request->ingresado == "ingresado" ) {
            $trabajo->estado = "Por revisar";
            $trabajo->por_revisar_at = Carbon::now();
        }
        $trabajo->save();
        flash('Se registró un nuevo trabajo de taller','success');
        return redirect()->route('trabajos_de_taller.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $trabajo = TrabajoDeTaller::ownerOrAdmin( Auth::user() )->find($id);
        return view('',['trabajo' => $trabajo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $titulares = Titular::ownerOrAdmin( Auth::user() )->select('nombre', 'apellido', 'id')->orderBy('apellido')->orderBy('nombre')->get();
        $titulares->each( function ($t){
            $t->full_name = $t->apellido . ', ' . $t->nombre;
            unset( $t->nombre, $t->apellido );
        });
        $titulares = array_pluck($titulares->toArray(), 'full_name', 'id');


        $servicios = ServicioDeTaller::pluck('nombre','id');


        $trabajo = TrabajoDeTaller::ownerOrAdmin( Auth::user() )->find($id);
        $trabajo->vehiculo;

        $vehiculos = Vehiculo::ownerOrAdmin( Auth::user() )->where('titular_id', $trabajo->vehiculo->titular_id)->select('dominio', 'id', 'marca_id', 'modelo_id')->limit(100)->get();
        $vehiculos->each(function ($v){
            $v->marca;
            $v->modelo;
            $v->nombre = $v->marca->nombre. " " . $v->modelo->nombre . " - " . $v->dominio;
            unset( $v->marca, $v->modelo, $v->dominio, $v->marca_id, $v->modelo_id );
        });
        $vehiculos = array_pluck( $vehiculos->toArray(), 'nombre', 'id');


        return view('resources.trabajos_de_taller.edit',['trabajo' => $trabajo, 'titulares' => $titulares, 'servicios' => $servicios, 'vehiculos' => $vehiculos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $trabajo = TrabajoDeTaller::ownerOrAdmin( Auth::user() )->find($id);

        if ( $request->estado != $trabajo->estado) {
            //Si paso a no ingresado, DRY, seteo a null
            if ($request->estado == 'No ingresado') {
                $trabajo->retirado_at = null;
                $trabajo->finalizado_at = null;
                $trabajo->en_proceso_at = null;
                $trabajo->por_revisar_at = null;
            }
            // De no ingresado a cualquier estado, uso el cascading del switch
            if ( $trabajo->estado == 'No ingresado')
                switch ( $request->estado ) {
                    case 'Retirado':
                        $trabajo->retirado_at = Carbon::now();
                    case 'Finalizado':
                        $trabajo->finalizado_at = Carbon::now();
                    case 'En proceso':
                        $trabajo->en_proceso_at = Carbon::now();
                    case 'Por revisar':
                        $trabajo->por_revisar_at = Carbon::now();
                }

            if ( $trabajo->estado == 'Por revisar')
                switch ( $request->estado ) {
                    case 'Retirado':
                        $trabajo->retirado_at = Carbon::now();
                    case 'Finalizado':
                        $trabajo->finalizado_at = Carbon::now();
                    case 'En proceso':
                        $trabajo->en_proceso_at = Carbon::now();
                }
            if ( $trabajo->estado == 'En proceso')
                switch ( $request->estado ) {
                    case 'Por revisar':
                        $trabajo->por_revisar_at = Carbon::now();
                        $trabajo->en_proceso_at = null;
                        break;
                    case 'Retirado':
                        $trabajo->retirado_at = Carbon::now();
                    case 'Finalizado':
                        $trabajo->finalizado_at = Carbon::now();
                }
            if ( $trabajo->estado == 'Finalizado')
                switch ( $request->estado ) {
                    case 'Por revisar':
                        $trabajo->finalizado_at = null;
                        $trabajo->en_proceso_at = null;
                        $trabajo->por_revisar_at = Carbon::now();
                        break;
                    case 'En proceso':
                        $trabajo->finalizado_at = null;
                        $trabajo->en_proceso_at = Carbon::now();
                        break;
                    case 'Retirado':
                        $trabajo->retirado_at = Carbon::now();
                }
            if ( $trabajo->estado == 'Retirado')
                switch ( $request->estado ) {
                    case 'Por revisar':
                        $trabajo->retirado_at = null;
                        $trabajo->finalizado_at = null;
                        $trabajo->en_proceso_at = null;
                        $trabajo->por_revisar_at = Carbon::now();
                        break;
                    case 'En proceso':
                        $trabajo->retirado_at = null;
                        $trabajo->finalizado_at = null;
                        $trabajo->en_proceso_at = Carbon::now();
                        break;
                    case 'Finalizado':
                        $trabajo->retirado_at = null;
                        $trabajo->finalizado_at = Carbon::now();

                }
        }
        $trabajo->fill( $request->all() );
        $trabajo->user_id = $trabajo->user_id ? $trabajo->user_id : Auth::user()->id;
        $trabajo->save();
        flash('Trabajo de taller actualizado correctamente','success');
        return redirect()->route('trabajos_de_taller.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $trabajo = TrabajoDeTaller::ownerOrAdmin( Auth::user() )->find($id);
        $trabajo->delete();
        flash('','');
        return redirect()->route('trabajos_de_taller.index');
    }

    public function advance( int $id )
    {
        $trabajo = TrabajoDeTaller::ownerOrAdmin( Auth::user() )->find($id);
        switch ( $trabajo->estado ) {
            case 'No ingresado':
                $trabajo->estado = 'Por revisar';
                $trabajo->por_revisar_at = Carbon::now();
                break;
            case 'Por revisar':
                $trabajo->estado = 'En proceso';
                $trabajo->en_proceso_at = Carbon::now();
                break;
            case 'En proceso':
                $trabajo->estado = 'Finalizado';
                $trabajo->finalizado_at = Carbon::now();
                break;
            case 'Finalizado':
                $trabajo->estado = 'Retirado';
                $trabajo->retirado_at = Carbon::now();
                break;
        }
        $trabajo->save();
        flash('Trabajo de taller actualizado correctamente','success');
        return redirect()->route('trabajos_de_taller.index');
    }
}
