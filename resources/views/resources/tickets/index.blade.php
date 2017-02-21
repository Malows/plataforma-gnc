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
            <div class="col-md-12">
                <a href="{{ route('tickets.create') }}" class="pull-right btn btn-primary">Nuevo ticket</a>
                @include('layouts.partials.flashMessage')
                @foreach($tickets as $tic)
                    <div class="col-md-6 col-md-offset-3 box">
                        <a href="{{ route('tickets.show', $tic) }}">
                            <div class="ticket-box">
                                @if(Auth::user()->id != $tic->user->id)
                                    <p class="ticket-from">{{ $tic->user->name }}</p>
                                @endif
                                <p class="ticket-body">
                                    {{ $tic->mensaje }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
                @if( $tickets->count() === 0 and ! Auth::user()->es_admin() )
                    <p>No hay ningún ticket registrado por ud.</p>
                @elseif( $tickets->count() === 0 and Auth::user()->es_admin() )
                    <p>No hay ningún ticket para atender (yay!)</p>
                @endif
            </div>
        </div>
    </div>
    @foreach($tickets as $tic)
        <div class="modal fade" id="ticket-modal{{ $tic->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Ticket de {{$tic->user->name}}</h4>
                    </div>
                    <div class="modal-body">
                        <p class="ticket-body">{{ $tic->mensaje }}</p>
                        <hr>
                        <p class="text-muted align-right">{{ "Creado " . $tic->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="modal-footer">
                        {{ Form::open(['route' => ['tickets.destroy', $tic], 'method' => 'DELETE', 'class' => 'pull-right']) }}
                        {{ Form::submit('Concluir ticket', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
