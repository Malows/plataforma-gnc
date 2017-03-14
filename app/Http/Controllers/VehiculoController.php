<?php

namespace App\Http\Controllers;

use App\MarcaAutos;
use App\ModeloAutos;
use App\Titular;
use App\User;
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
        $vehiculos = Vehiculo::ownerOrAdmin( Auth::user() )->orderBy('updated_at')->paginate(20);
        $vehiculos->each(function($vehiculo){
            $vehiculo->titular;
            $vehiculo->modelo;
            $vehiculo->marca;
        });
        return view('resources.vehiculos.index', ['vehiculos' => $vehiculos]);
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

        $marcas = MarcaAutos::pluck('nombre', 'id');

        return view('resources.vehiculos.create', ['titulares'=>$aux, 'marcas' => $marcas]);
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
        $vehiculo->user_id = Auth::user()->id;
        $vehiculo->save();
        flash('Vehículo creado correctamente','success');
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
        $vehiculo = Vehiculo::ownerOrAdmin( Auth::user() )->find($id);
        $vehiculo->marca;
        $vehiculo->modelo;
        $vehiculo->titular;
//        if( Auth::user()->tipo_usuario_id <= 5 ) {
//            $vehiculo->trabajos_de_taller;
//        }
        return view('resources.vehiculos.show', ['vehiculo' => $vehiculo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::ownerOrAdmin(Auth::user())->find($id);
        $vehiculo->modelo;
        $vehiculo->marca = $vehiculo->modelo->marca;
        $vehiculo->titular;

        $titulares = Titular::ownerOrAdmin( Auth::user() )->select('nombre', 'apellido', 'id')
            ->orderBy('apellido')->orderBy('nombre')->get();
        $titulares->each( function ($t){
            $t->full_name = $t->apellido . ', ' . $t->nombre;
            unset( $t->nombre );
            unset( $t->apellido );
        });
        $aux = array_pluck($titulares->toArray(), 'full_name', 'id');

        $marcas = MarcaAutos::pluck('nombre', 'id')->toArray();
        $modelos = ModeloAutos::where('marca_autos_id', $vehiculo->marca_id)->pluck('nombre','id')->toArray();

        return view('resources.vehiculos.edit',
            ['vehiculo' => $vehiculo, 'titulares' => $aux, 'marcas' => $marcas, 'modelos' => $modelos]);
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
        $vehiculo = Vehiculo::ownerOrAdmin( Auth::user() )->find($id);
        $vehiculo->fill( $request->all() );
        $vehiculo->user_id = ( $vehiculo->user_id ) ? $vehiculo->user_id : Auth::user()->id;
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
        $vehiculo = Vehiculo::ownerOrAdmin( Auth::user() )->find($id);
        $vehiculo->delete();
        flash('Vehículo eliminado correctamente. Para restaurar el vehículo eliminar, consulte un administrador','info');
        return redirect()->route('vehiculos.index');
    }

    /**
     * Erase the specified softDeleted resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function erase( int $id )
    {
        $vehiculo = Vehiculo::ownerOrAdmin( Auth::user() )->find( $id );
        $vehiculo->forceDelete();
        flash('Vehiculo borrado permanentemente','warning');
        return redirect()->route('vehiculos.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore( int $id )
    {
        $vehiculo = Vehiculo::ownerOrAdmin( Auth::user() )->find( $id );
        $vehiculo->restore();
        flash('Vehiculo restaurado correctamente','success');
        return redirect()->route('vehiculos.index');
    }

    public function  api_index(Request $request)
    {
        $user = User::find( $request->user );
        $vehiculos = Vehiculo::ownerOrAdmin($user)
            ->where('titular_id', $request->titular)->select('dominio', 'id', 'marca_id', 'modelo_id')->limit(100)->get();
        $vehiculos->each(function ($v){
            $v->marca;
            $v->modelo;
            $v->nombre = $v->marca->nombre. " " . $v->modelo->nombre . " - " . $v->dominio;
            unset($v->marca);
            unset($v->modelo);
            unset($v->dominio);
            unset($v->marca_id);
            unset($v->modelo_id);
        });
        return ['data' => [ 'vehiculos' => $vehiculos]];
    }
}
