@extends('layouts.app')

@section('htmlheader_title', trans('message.marcas_de_autos').' - '.trans('message.edit') )
@section('contentheader_title', trans('message.edit') .' '. strtolower(trans('message.marcas_de_autos')) )
@section('contentheader_description', 'Edita un fabricante de autos registrado')

@section('leveler')
    <li><a href="{{  route('marcas_de_autos.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.marcas_de_autos') }}</a></li>
    <li>{{ $marca->nombre }}</li>
    <li class="active">{{ trans('message.edit') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.partials.errors')
                {!! Form::open(['route' => ['marcas_de_autos.update', $marca], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre del fabricante') !!}
                    {!! Form::text('nombre', $marca->nombre, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Enviar', [ 'class'=>'btn btn-primary' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
