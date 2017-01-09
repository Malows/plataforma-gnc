@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('message.usuarios').' - Crear' }}
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="col-md-8 col-md-offset-2">
                {!! Form::open(['route' => ['usuarios.store'], 'method' => 'POST']) !!}
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
                    {!! Form::text('password', null, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('repassword','Confirmar contraseña') !!}
                    {!! Form::text('repassword', null, ['class' =>'form-control', 'required']) !!}
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
                            <label class="btn btn-primary">
                                <input type="radio" name="duracion_de_licencia" id="duarcion1" autocomplete="off">1 Mes
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="duracion_de_licencia" id="duracion2" autocomplete="off">1 Año
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::label('habilitado','Habilitado') !!}
                        <br>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary">
                                <input type="radio" name="habilitado" id="habilitado1" value="si">Sí
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="habilitado" id="habilitado2" value="no">No
                            </label>
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
