@extends('layouts.app')
@section('htmlheader_title', trans('message.servicios_de_taller') )
@section('contentheader_title', trans('message.servicios_de_taller') )
@section('contentheader_description', 'Lista de posibles servicios que brinda su taller')

@section('leveler')
    <li><i class="fa fa-dashboard"></i><a href="{{ route('servicios_de_taller.index') }}"> {{ trans('message.servicios_de_taller') }}</a></li>
    <li>{{ trans('message.show') }}</li>
    <li class="active"> {{$servicio->nombre}}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <h3>{{$servicio->nombre}}</h3>
        <ul>
            @forelse( $trabajos as $t )
                <li>
                    <p>
                        <strong>Vehículo:</strong> {{ $t->vehiculo->dominio }} <br>
                        <strong>Turno: </strong> {{ $t->fecha_de_turno }} <br>
                        <strong>Estado actual: </strong> {{$t->estado}} <br>
                        @if( $t->finalizado_at )
                            Ingresado: {{$t->por_revisar_at}} -
                            En Proceso: {{$t->en_proceso_at}} -
                            Finalizado: {{$t->finalizado_at}}
                        @elseif( $t->en_proceso_at )
                            Ingresado: {{$t->por_revisar_at}} -
                            En Proceso: {{$t->en_proceso_at}}
                        @elseif( $t->por_revisar_at )
                            Ingresado: {{$t->por_revisar_at}}
                        @endif
                    </p>
                </li>
            @empty
                <p class="text-muted" style="padding: 10em 25em;">Nada registrado o pendiente</p>
            @endforelse
        </ul>
    </div>
@endsection
