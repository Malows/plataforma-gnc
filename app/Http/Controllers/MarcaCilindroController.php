<?php

namespace App\Http\Controllers;

use App\DatosCilindro;
use App\MarcaCilindro;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarcaCilindroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = MarcaCilindro::orderBy('nombre')->paginate(20);
        return view('resources.plata.marcas_de_cilindros.index',['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resources.plata.marcas_de_cilindros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marca = new MarcaCilindro( $request->all() );
        $marca->save();
        flash('Marca de cilindros creada correctamente', 'success');
        return redirect()->route('marcas_de_cilindros.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = MarcaCilindro::find($id);
        $datos = DatosCilindro::where('marca_cilindro_id', $marca->id)->orderBy('codigo_homologado')->get();
        return view('resources.plata.marcas_de_cilindros.show',['marca' => $marca, 'datos' => $datos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marca = MarcaCilindro::ownerOrAdmin(Auth::user())->find($id);
        return view('resources.plata.marcas_de_cilindros.edit',['marca' => $marca]);
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
        $marca = MarcaCilindro::ownerOrAdmin(Auth::user())->find($id);
        $marca->fill( $request->all() );
        $marca->save();
        flash('Se modificó correctamente la marca de cilindros', 'success');
        return redirect()->route('marcas_de_cilindros.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $marca = MarcaCilindro::find($id);
        $marca->user_id = 1;
        $marca->save();
        $ticket = new Ticket();
        $ticket->user_id = $user->id;
        $ticket->mensaje = "El usuario '$user->name' <ID: $user->id> intentó eliminar la marca de cilindros '$marca->nombre' <ID: $marca->id>";
        $ticket->save();
        flash('Se notificó a los administradores del sistema para su futura revisión','info');
        return redirect()->route('marcas_de_cilindros.index');
    }
}
