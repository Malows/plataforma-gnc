@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('message.usuarios').' - Eliminar' }}
@endsection

@section('contentheader_title', trans('message.delete') .' '. strtolower(trans('message.usuarios')) )

@section('leveler')
    <li><a href="{{  route('usuarios.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.usuarios') }}</a></li>
    <li class="active">{{ trans('message.delete') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>Un momento!</h1>
                    <p>Eliminar un usuario es un proceso irreversible</p>
                    <p>Tal vez quieras simplemente <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-info">deshabilitarlo</a>
                        desde el panel de edición</p>
                    <hr>
                    <p>O si realmente querés eliminarlo, se transferiran todos sus recursos a tu propiedad</p>
                    <hr>
                    {!! Form::open(['route' => ['usuarios.destroy', $usuario], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Eliminar definitivamente', [ 'class'=>'btn btn-danger', 'role'=>'button' ]) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection
