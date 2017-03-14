@extends('layouts.app')
@section('htmlheader_title', trans('message.servicios_de_taller') )
@section('contentheader_title', trans('message.servicios_de_taller') )
@section('contentheader_description', 'Lista de posibles servicios que brinda su taller')

@section('leveler')
    <li><i class="fa fa-dashboard"></i><a href="{{ route('servicios_de_taller.index') }}"> {{ trans('message.servicios_de_taller') }}</a></li>
    <li>{{ trans('message.edit') }}</li>
    <li class="active"> {{$servicio->nombre}}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Form::open(['route' => 'servicios_de_taller.update', 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre del servicio') !!}
                    {!! Form::text('nombre', $servicio->nombre, ['placeholder' => 'Ingrese un nombre para el servicio', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection