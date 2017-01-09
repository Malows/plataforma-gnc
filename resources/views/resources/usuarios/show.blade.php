@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('message.usuarios').' - Ver' }}
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="col-md-12">
                <div class="form-group">
{{--                    {{dd($usuario)}}--}}
                    {!! Form::label('name','Nombre') !!}
                    {!! Form::text('name', $usuario->name, ['class' =>'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email','Correo Electrónico') !!}
                    {!! Form::text('email', $usuario->email, ['class' =>'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tipo_usuario','Tipo de usuario') !!}
                    {!! Form::text('tipo_usuario', $usuario->tipo_usuario->nombre, ['class' =>'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('fecha_de_licencia','Fecha de licencia') !!}
                    {!! Form::text('fecha_de_licencia', $usuario->fecha_de_licencia, ['class' =>'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('duracion_de_licencia','Duración de licencia') !!}
                    {!! Form::text('duracion_de_licencia', $usuario->duracion_de_licencia, ['class' =>'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('habilitado','Habilitado') !!}
                    {!! Form::text('habilitado', $usuario->habilitado, ['class' =>'form-control', 'readonly']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
