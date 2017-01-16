@extends('layouts.app')

@section('htmlheader_title', trans('message.tipo_de_usuarios').' - '.trans('message.edit') )
@section('contentheader_title', trans('message.edit') .' '. strtolower(trans('message.tipo_de_usuarios')) )
@section('contentheader_description', 'Es una mala idea andar por acá')

@section('leveler')
    <li><a href="{{  route('tipo_de_usuarios.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.tipo_de_usuarios') }}</a></li>
    <li class="active">{{ trans('message.edit') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.partials.errors')
                {!! Form::open(['route' => ['tipo_de_usuarios.update', $tipo_usuario], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('nombre','Nombre') !!}
                    {!! Form::text('nombre', $tipo_usuario->nombre, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Enviar', [ 'class'=>'btn btn-primary' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection