@extends('layouts.app')

@section('htmlheader_title', trans('message.modelos_de_autos').' - '.trans('message.delete') )
@section('contentheader_title', trans('message.delete') .' '. strtolower(trans('message.modelos_de_autos')) )
@section('contentheader_description', 'Eliminar un fabricante de autos')

@section('leveler')
    <li><a href="{{ route('modelos_de_autos.index', $marca) }}"><i class="fa fa-dashboard"></i> {{ trans('message.modelos_de_autos') }}</a></li>
    <li class="active">{{ trans('message.delete') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>Un momento!</h1>
                    <p>Eliminar un modelo de auto es un proceso irreversible</p>
                    <p>Y realmente afecta al funcionamiento del sistema</p>
                    <hr>
                    <p>La existencia de este registro será evaluada por los administradores</p>
                    <hr>
                    {!! Form::open(['route' => ['modelos_de_autos.destroy', $marca, $modelo], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Comprendido', [ 'class'=>'btn btn-danger', 'role'=>'button' ]) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection