@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('message.usuarios').' - Editar' }}
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="col-md-12">
                {!! Form::open(['route' => ['usuarios.update', $usuario], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {{--                    {{dd($usuario)}}--}}
                    {!! Form::label('name','Nombre') !!}
                    {!! Form::text('name', $usuario->name, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email','Correo Electrónico') !!}
                    {!! Form::text('email', $usuario->email, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tipo_usuario','Tipo de usuario') !!}
                    {!! Form::text('tipo_usuario', $usuario->tipo_usuario->nombre, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('fecha_de_licencia','Fecha de licencia') !!}
                    {!! Form::text('fecha_de_licencia', $usuario->fecha_de_licencia, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('duracion_de_licencia','Duración de licencia') !!}
                    {!! Form::text('duracion_de_licencia', $usuario->duracion_de_licencia, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('habilitado','Habilitado') !!}
                    {!! Form::text('habilitado', $usuario->habilitado, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Enviar', [ 'class'=>'btn btn-primary' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
