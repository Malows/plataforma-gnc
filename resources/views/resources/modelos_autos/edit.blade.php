@extends('layouts.app')

@section('htmlheader_title', trans('message.modelos_de_autos').' - '.trans('message.edit') )
@section('contentheader_title', trans('message.edit') .' '. strtolower(trans('message.modelos_de_autos')) )
@section('contentheader_description', 'Edita modelos de autos de un fabricante registrado')

@section('leveler')
    <li><a href="{{  route('modelos_de_autos.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.modelos_de_autos') }}</a></li>
    <li class="active">{{ trans('message.edit') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.partials.errors')
                {!! Form::open(['route' => ['modelos_de_autos.update', $modelo], 'method' => 'PUT']) !!}
                <div class="row">
                    <div class="form-group col-md-6">
                        {!! Form::label('marca_id', 'Fabricante') !!}
                        {!! Form::select('marca_id', $marcas, $modelo->marca_id, ['class' =>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::label('nombre','Nombre') !!}
                        {!! Form::text('nombre', $modelo->nombre, ['class' =>'form-control', 'required']) !!}
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
