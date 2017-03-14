@extends('layouts.app')

@section('htmlheader_title', trans('message.tickets') )
@section('contentheader_title', trans('message.tickets') )

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.tickets') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 box">
                <div class="ticket-box">
                    @if(Auth::user()->id != $ticket->user->id)
                        <p class="ticket-from">{{ $ticket->user->name }}</p>
                    @endif
                    <p class="ticket-body">
                        {{ $ticket->mensaje }}
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-muted align-right">Creado {{ $ticket->created_at->diffForHumans() }}</p>
                            <br>
                            @if($ticket->created_at != $ticket->updated_at)
                                <p class="text-muted align-right">Editado {{ $ticket->updated_at->diffForHumans() }}</p>
                            @endif
                        </div>

                        {{ Form::open(['route' => ['tickets.destroy', $ticket], 'method' => 'DELETE', 'class' => 'pull-right']) }}
                        {{ Form::submit('Concluir ticket', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection