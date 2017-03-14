<?php

namespace App\Http\Controllers;


use App\Localidad;
use App\Provincia;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        $titulares = Titular::ownerOrAdmin( Auth::user() )->orderBy('apellido')->orderBy('nombre')->paginate(20);
        return view('resources.bronce.titulares.index')->with('titulares',$titulares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View View
     */
    public function create()
    {
        $provincias = Provincia::pluck('nombre','id');
        return view('resources.bronce.titulares.create', ['provincias' => $provincias]);
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
        $titular = Titular::ownerOrAdmin( Auth::user() )->find($id);
        $titular->vehiculos;
        $titular->localidad;
        return view('resources.bronce.titulares.show')->with('titular',$titular);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function edit($id)
    {
        $provincias = Provincia::pluck('nombre','id');
        $titular = Titular::ownerOrAdmin(Auth::user() )->find($id);
        $titular->vehiculos;
        $titular->localidad;
        $localidades = Localidad::where('provincia_id',$titular->localidad->provincia_id)->pluck('nombre','id');
        return view('resources.bronce.titulares.edit',
            ['titular' => $titular, 'provincias'=> $provincias,'localidades' =>$localidades]);
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
        $titular = Titular::ownerOrAdmin( Auth::user() )->find($id);
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
        $titular = Titular::ownerOrAdmin( Auth::user() )->find( $id );
        $titular->vehiculos;
        return view('resources.bronce.titulares.delete')->with('titular',$titular);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $titular = Titular::ownerOrAdmin( Auth::user() )->find($id);
        $titular->vehiculos;
        $titular->vehiculos->each(function ($v){
            $v->delete();
        });
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
        $titular = Titular::ownerOrAdmin( Auth::user() )->find( $id );
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
        $titular = Titular::ownerOrAdmin( Auth::user() )->find( $id );
        $titular->restore();
        flash('Titular restaurado correctamente','success');
        return redirect()->route('titulares.index');
    }

    public function api_index(Request $request)
    {
        $user = User::find( $request->user );
        $titulares = Titular::ownerOrAdmin($user)
            ->where('nombre', 'like', '%'.$request->value.'%')
            ->whereOr('apellido', 'like', '%'.$request->value.'%')
            ->select('nombre', 'apellido', 'id')
            ->limit(100)->get();
        return ['data' => [ 'titulares' => $titulares]];
    }
}
