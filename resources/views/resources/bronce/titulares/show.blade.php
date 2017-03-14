@extends('layouts.app')

@section('htmlheader_title', trans('message.titulares') )
@section('contentheader_title', trans('message.titulares') )
@section('contentheader_description', 'Detalles de titular')

@section('leveler')
    <li><a href="{{route('titulares.index')}}"><i class="fa fa-dashboard"></i> {{ trans('message.titulares') }}</a></li>
    <li> {{ trans('message.show') }}</li>
    <li class="active"> {{"$titular->nombre $titular->apellido"}}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 well">
                <h3>Nombre</h3>
                <p>{{ "$titular->apellido, $titular->nombre" }}</p>
                <hr>
                <h3>Domicilio</h3>
                <p>
                    {{ $titular->domicilio }}<br>
                    {{ $titular->localidad->nombre . " - CP ". $titular->localidad->codigo_postal }}<br>
                    {{ $titular->localidad->provincia->nombre }}
                </p>
                <h3>Contacto</h3>
                <h4>Teléfono: <small>{{ $titular->telefono }}</small></h4>
                <h4>Email: <small>{{$titular->email}}</small></h4>
                <h4>Otros datos: <br><small>{{$titular->contacto}}</small></h4>
                <hr>
                <h3>{{trans('message.vehiculos')}}</h3>
                <ul>
                    @foreach($titular->vehiculos as $vehiculo)
                        <li>
                            <a href="{{ route('vehiculos.show', $vehiculo) }}">
                                {{$vehiculo->dominio." - ".$vehiculo->modelo->marca->nombre." ".$vehiculo->modelo->nombre." ".$vehiculo->año}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection