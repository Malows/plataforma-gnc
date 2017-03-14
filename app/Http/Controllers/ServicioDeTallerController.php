<?php

namespace App\Http\Controllers;

use App\ServicioDeTaller;
use App\Ticket;
use App\TrabajoDeTaller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicioDeTallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios_propios = ServicioDeTaller::ownerOrAdmin( Auth::user() )->get();
        if ( Auth::user()->es_admin() ) {
            $servicios_ajenos = [];
        } else {
            $servicios_ajenos = ServicioDeTaller::where('user_id', '!=', Auth::user()->id );
        }
        return view('resources.servicios_de_taller.index', ['servicios_propios' => $servicios_propios, 'servicios_ajenos' => $servicios_ajenos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resources.servicios_de_taller.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servicio = new ServicioDeTaller( $request->all() );
        $servicio->user_id = Auth::user()->id;
        $servicio->save();
        flash('Servicio de taller creado correctamente', 'success');
        return redirect()->route('servicios_de_taller.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $servicio = ServicioDeTaller::find($id);
        $trabajos = TrabajoDeTaller::ownerOrAdmin( Auth::user() )->where('servicio_de_taller_id', $id)->whereNull('retirado_at')
            ->orderBy('updated_at','DESC')->paginate(20);
        $trabajos->each(function($f){
            $f->vehiculo;
        });
        return view('resources.servicios_de_taller.show',['servicio' => $servicio, 'trabajos' => $trabajos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $servicio = ServicioDeTaller::ownerOrAdmin( Auth::user() )->find($id);
        return view('resources.servicios_de_taller.edit',['servicio', $servicio]);
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
        $servicio = ServicioDeTaller::find($id);
        $servicio->fill( $request->all() );
        $servicio->user_id = $servicio->user_id ? $servicio->user_id : Auth::user();
        $servicio->save();
        flash('Servicio de taller actualizado correctamente', 'success');
        return redirect()->route('servicios_de_taller.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $servicio = ServicioDeTaller::find($id);
        $servicio->user_id = 1;
        $servicio->save();
        flash('Eliminar este elemento puede perjudicar al funcionamiento del sistema, se le notificará a los administradores y se pondran en contacto con ud.', 'info');
        $tick = new Ticket();
        $user = Auth::user();
        $tick->mensaje = "El usuario $user->name <ID $user->id> intentó eliminar el servicio de taller <ID $servicio->id>";
        $tick->user_id = 1;
        $tick->save();
        return redirect()->route('servicios_de_taller.index');
    }
}
