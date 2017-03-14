@extends('layouts.app')
@section('htmlheader_title', trans('message.servicios_de_taller') )
@section('contentheader_title', trans('message.servicios_de_taller') )
@section('contentheader_description', 'Agregar un servicios de taller')

@section('leveler')
    <li><i class="fa fa-dashboard"></i> {{ trans('message.servicios_de_taller') }}</li>
    <li class="active">{{ trans('message.create') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Form::open(['route' => 'servicios_de_taller.store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre del servicio') !!}
                    {!! Form::text('nombre', null, ['placeholder' => 'Ingrese un nombre para el servicio', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection