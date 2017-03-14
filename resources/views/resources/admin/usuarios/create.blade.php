@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('message.usuarios').' - Crear' }}
@endsection

@section('contentheader_title', trans('message.create') .' '. strtolower(trans('message.usuarios')) )

@section('leveler')
    <li><a href="{{  route('usuarios.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.usuarios') }}</a></li>
    <li class="active">{{ trans('message.create') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.partials.errors')
                {!! Form::open(['route' => 'usuarios.store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('name','Nombre') !!}
                    {!! Form::text('name', null, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email','Correo Electrónico') !!}
                    {!! Form::text('email', null, ['class' =>'form-control', 'required']) !!}
                </div>
                <hr>
                <div class="form-group">
                    {!! Form::label('password','Contraseña') !!}
                    {!! Form::password('password', ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password_confirmation','Confirmar contraseña') !!}
                    {!! Form::password('password_confirmation', ['class' =>'form-control', 'required']) !!}
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-4">
                        {!! Form::label('tipo_usuario_id','Tipo de usuario') !!}
                        {!! Form::select('tipo_usuario_id', $tipos_de_usuarios, '6', ['class' =>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::label('duracion_de_licencia','Duración de licencia') !!}
                        <br>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary">{!! Form::radio('duracion_de_licencia', '30') !!}Un Mes</label>
                            <label class="btn btn-primary">{!! Form::radio('duracion_de_licencia', '365') !!}Un Año</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::label('habilitado','Habilitado') !!}
                        <br>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary">{!! Form::radio('habilitado', '1') !!}Sí</label>
                            <label class="btn btn-primary">{!! Form::radio('habilitado', '0') !!}No</label>
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
