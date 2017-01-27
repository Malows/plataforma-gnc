@extends('layouts.app')

@section('htmlheader_title', trans('message.modelos_de_autos').' - '.trans('message.create') )
@section('contentheader_title', trans('message.create') .' '. strtolower(trans('message.modelos_de_autos')) )
@section('contentheader_description', 'Registra modelos de autos de un fabricante registrado')

@section('leveler')
    <li><a href="{{  route('modelos_de_autos.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.modelos_de_autos') }}</a></li>
    <li class="active">{{ trans('message.create') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.partials.errors')
                {!! Form::open(['route' => 'modelos_de_autos.store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('marca_id', 'Fabricante') !!}
                    {!! Form::select('marca_id', $marcas, null, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('nombre','Nombre') !!}
                    {!! Form::text('nombre', null, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Enviar', [ 'class'=>'btn btn-primary' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
