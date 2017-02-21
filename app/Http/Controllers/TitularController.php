<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Response;
use Illuminate\Http\Request;
//use Illuminate\View\View;
use App\Titular;
use App\Vehiculo;

class TitularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View View
     */
    public function index()
    {
        $titulares = NULL;
        if ( Auth::user()->es_admin() ){
            $titulares = Titular::paginate(20);
        } else {
            $titulares = Titular::where('user_id', Auth::user()->id)
                ->sortBy('apellido')->sortBy('nombre')->paginate(20);
        }
        return view('resources.titulares.index')->with('titulares',$titulares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View View
     */
    public function create()
    {
        return view('resources.titulares.create');
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
        $titular->user_id = Auth::user()->id;
        $titular->save();
        flash('Titular creado correctamente','success');
        return redirect()->route('titulares.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function show($id)
    {
        $titular = Titular::find($id);
        $titular->vehiculos;
        $titular->localidad;
        return view('resources.titulares.show')->with('titular',$titular);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function edit($id)
    {
        $titular = Titular::find($id);
        $titular->vehiculos;
        return view('resources.titulares.edit')->with('titular',$titular);
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
        $titular->user_id = ( $titular->user_id ) ? $titular->user_id : Auth::user()->id;
        $titular->save();
        flash('Los datos del titular se editaron correctamente','success');
        return redirect()->route('titulares.index');
    }

    /**
     * Show the form for deleting the specified resource
     * 
     * @param int  $id
     * @return \Illuminate\View\View View
     */
    public function delete( int $id )
    {
        $titular = Titular::find( $id );
        $titular->vehiculos;
        return view('resources.titulares.delete')->with('titular',$titular);
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
        flash('Titular eliminado correctamente. Para restaurar el titular eliminar, consulte un administrador','info');
        return redirect()->route('titulares.index');
    }

    /**
     * Erase the specified softDeleted resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function erase( $id )
    {
        $titular = Titular::find( $id );
        $titular->forceDelete();
        flash('Titular borrado permanentemente','warning');
        return redirect()->route('titulares.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore( $id )
    {
        $titular = Titular::find( $id );
        $titular->restore();
        flash('Titular restaurado correctamente','success');
        return redirect()->route('titulares.index');
    }
}
