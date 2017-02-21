<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::ownerOrAdmin( Auth::user() )->orderBy('created_at','ASC')->paginate(10);

        $tickets->each( function ($ticket) {
            $ticket->user;
        });
        return view('resources.tickets.index')->with('tickets',$tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( ! Auth::user()->es_admin() ) {
            flash('Puede reducir el tiempo de espera para la respuesta de su ticket adquiriendo el servicio de <a href="#">Alerta Inmediata</a>','info');
        }
        return view('resources.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $ticket = new Ticket( $request->fill() );
        $ticket->user_id = Auth::user()->id;
        $ticket->save();
        flash('Ticket generado correctamente, pronto recibirá asistencia de un administrador', 'success');
        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( int $id )
    {
        $ticket = Ticket::ownerOrAdmin( Auth::user() )->find( $id );
        return view('resources.tickets.show')->with('ticket',$ticket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( int $id )
    {
        $ticket = Ticket::ownerOrAdmin( Auth::user() )->find( $id );

        return view('resources.tickets.edit')->with('ticket',$ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id )
    {
        $ticket = Ticket::ownerOrAdmin( Auth::user() )->find( $id );
        $ticket->fill( $request->all() );
        $ticket->user_id = ( $ticket->user_id ) ? $ticket->user_id : Auth::user()->id;
        $ticket->save();
        flash('Ticket editado correctamente, pronto recibirá asistencia de un administrador', 'success');
        return redirect()->route('tickets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( int $id )
    {
        $ticket = Ticket::ownerOrAdmin( Auth::user() )->find( $id );
        $ticket->delete();
        flash('Ticket marcado como concluido','success');
        return redirect()->route('tickets.index');
    }
}
