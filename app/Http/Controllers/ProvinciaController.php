<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provincia;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View View
     */
    public function index()
    {
        $provincias = Provincia::orderBy('nombre', 'ASC')->get();
        return view('resources.provincias.index')->with('provincias',$provincias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View View
     */
    public function create()
    {
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provincia = new Provincia( $request->all() );
        $provincia->save();
        return redirect()->route('provincias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function show($id)
    {
        $provincia = Provincia::find($id);
        return view('')->with('provincia',$provincia);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View View
     */
    public function edit($id)
    {
      $provincia = Provincia::find($id);
      return view('')->with('provincia',$provincia);
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
      $provincia = Provincia::find($id);
      $provincia->fill( $request->all() );
      return redirect()->route('provincias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $provincia = Provincia::find($id);
      $provincia->delete();
      return redirect()->route('provincias.index');
    }
}
