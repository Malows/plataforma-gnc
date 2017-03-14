@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('message.usuarios').' - Ver' }}
@endsection

@section('contentheader_title', trans('message.show') .' '. strtolower(trans('message.usuarios')) )

@section('leveler')
    <li><a href="{{  route('usuarios.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.usuarios') }}</a></li>
    <li class="active">{{ trans('message.show') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="col-md-12">
                <ul>
                    <li>Nombre: {{ $usuario->name }}</li>
                    <li>Correo: {{ $usuario->email }}</li>
                    <li>Tipo de usuario: {{ $usuario->tipo_usuario->nombre }}</li>
                    @if($usuario->created_at)<li>Registrado el día: {{ $usuario->created_at->format('d/m/Y') }}</li>@endif
                    @if( ! $usuario->es_admin() )
                        <li>Inicio de licencia: {{ $usuario->inicio->format('d/m/Y') }}</li>
                        <li>Duración de licencia: {{ $usuario->duracion_de_licencia}}</li>
                        <li>Fin de licenacia: {{ $usuario->fin->format('d/m/Y') }}</li>
                        <li>Titulares registrados</li>
                        <ul>
                            @foreach($usuario->titulares as $titular)
                                <li>{{$titular->apellido . ', ' . $titular->nombre }} <a href="{{ route(['titulares.show', $titular]) }}">ver más</a></li>
                                <ul>
                                @foreach($titular->vehiculos as $vehiculo)
                                    <li>{{ $vehiculo->dominio }}</li>
                                @endforeach
                                </ul>
                            @endforeach
                        </ul>
                        <li>Marcas de autos registradas</li>
                        <ul>
                            @foreach($usuario->marcas_de_autos_registradas as $marca)
                                <li>{{ $marca->nombre }}</li>
                            @endforeach
                        </ul>
                        <li>Modelos de autos registrados</li>
                        <ul>
                            @foreach($usuario->modelos_de_autos_registrados as $modelo)
                                <li>{{ $modelo->marca->nombre .' - '. $modelo->nombre }}</li>
                            @endforeach
                        </ul>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
