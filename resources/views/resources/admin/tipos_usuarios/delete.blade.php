@extends('layouts.app')

@section('htmlheader_title', trans('message.tipo_de_usuarios').' - '.trans('message.delete') )
@section('contentheader_title', trans('message.delete') .' '. strtolower(trans('message.tipo_de_usuarios')) )
@section('contentheader_description', 'Es una mala idea andar por acá')

@section('leveler')
    <li><a href="{{  route('tipo_de_usuarios.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.tipo_de_usuarios') }}</a></li>
    <li class="active">{{ trans('message.delete') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>Un momento!</h1>
                    <p>Eliminar un tipo de usuario es un proceso irreversible</p>
                    <p>Y realmente afecta al funcionamiento del sistema</p>
                    <hr>
                    <p>Sencillamente no te voy a dejar hacerlo</p>
                    <hr>
                    {!! Form::open(['route' => ['tipo_de_usuarios.destroy', $tipo_usuario], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Comprendido', [ 'class'=>'btn btn-danger', 'role'=>'button' ]) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection