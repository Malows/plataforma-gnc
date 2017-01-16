@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('message.usuarios').' - Editar' }}
@endsection

@section('contentheader_title', trans('message.edit') .' '. strtolower(trans('message.usuarios')) )

@section('leveler')
    <li><a href="{{  route('usuarios.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.usuarios') }}</a></li>
    <li class="active">{{ trans('message.edit') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            {{--<div class="col-md-12">--}}
                @include('layouts.partials.errors')
                {!! Form::open(['route' => ['usuarios.update', $usuario], 'method' => 'PUT']) !!}
                {!! Form::hidden('id', $usuario->id) !!}
                <div class="form-group">
                    {!! Form::label('name','Nombre') !!}
                    {!! Form::text('name', $usuario->name, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email','Correo Electrónico') !!}
                    {!! Form::text('email', $usuario->email, ['class' =>'form-control', 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fecha_de_licencia','Fecha de licencia') !!}
                    {!! Form::text('fecha_de_licencia', $usuario->fecha_de_licencia, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('duracion_de_licencia','Duración de licencia') !!}
                    {!! Form::text('duracion_de_licencia', $usuario->duracion_de_licencia, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        {!! Form::label('agregar_licencia','Agregar tiempo de licencia') !!}
                        <br>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary active">
                                {!! Form::radio('agregar_licencia', '0', true) !!}No</label>
                            <label class="btn btn-primary">
                                {!! Form::radio('agregar_licencia', '30') !!}Un Mes</label>
                            <label class="btn btn-primary">
                                {!! Form::radio('agregar_licencia', '365') !!}Un Año</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::label('tipo_usuario','Tipo de usuario') !!}
                        {!! Form::select('tipo_usuario_id', $tipos_de_usuarios, $usuario->tipo_usuario_id, ['class' =>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::label('habilitado','Habilitado') !!}
                        <br>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary @if($usuario->habilitado) {{'active'}} @endif">
                                {!! Form::radio('habilitado', '1', ($usuario->habilitado)) !!}Sí</label>
                            <label class="btn btn-primary @if(!$usuario->habilitado) {{'active'}} @endif">
                                {!! Form::radio('habilitado', '0', (!$usuario->habilitado)) !!}No</label>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::submit('Enviar', [ 'class'=>'btn btn-primary' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
