@extends('layouts.app')

@section('htmlheader_title', trans('message.vehiculos') )
@section('contentheader_title', trans('message.vehiculos') )
@section('contentheader_description', 'Detalles de vehículo')

@section('leveler')
    <li><a href="{{route('titulares.index')}}"><i class="fa fa-dashboard"></i> {{ trans('message.vehiculos') }}</a></li>
    <li> {{ trans('message.show') }}</li>
    <li class="active"> {{ $vehiculo->dominio }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 well">
                <h3>Titular</h3>
                <p>{{ $vehiculo->titular->apellido.", ".$vehiculo->titular->nombre }}</p>
                <hr>
                <h3>Vehículo</h3>
                <p>
                    <strong>Dominio: </strong>{{ $vehiculo->dominio }}<br>
                    <strong>Modelo: </strong>{{ $vehiculo->marca->nombre ." ". $vehiculo->modelo->nombre ." - año " .$vehiculo->año }}
                </p>
                @if( isset($trabajos_de_taller) )
                    <h3>Trabajos de taller</h3>
                    <ul>
                        @foreach($trabajos_de_taller as $trabajo)
                            <li>
                                <p><strong>Servicio:</strong> {{$trabajo->servicio->nombre}}</p>
                                <p><strong>Estado actual:</strong> {{$trabajo->estado}}</p>
                                @if($trabajo->por_revisar_at)<p><strong></strong> {{$trabajo->por_revisar_at}}</p>@endif
                                @if($trabajo->en_proceso_at)<p><strong></strong> {{$trabajo->en_proceso_at}}</p>@endif
                                @if($trabajo->finalizado_at)<p><strong></strong> {{$trabajo->finalizado_at}}</p>@endif
                                @if($trabajo->retirado_at)<p><strong></strong> {{$trabajo->retirado_at}}</p>@endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection