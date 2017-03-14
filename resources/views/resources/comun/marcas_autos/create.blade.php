@extends('layouts.app')

@section('htmlheader_title', trans('message.marcas_de_autos').' - '.trans('message.create') )
@section('contentheader_title', trans('message.create') .' '. strtolower(trans('message.marcas_de_autos')) )
@section('contentheader_description', 'Registra un nuevo fabricante de autos')

@section('leveler')
    <li><a href="{{  route('marcas_de_autos.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.marcas_de_autos') }}</a></li>
    <li class="active">{{ trans('message.create') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.partials.errors')
                {!! Form::open(['route' => 'marcas_de_autos.store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre del fabricante') !!}
                    {!! Form::text('nombre', null, ['class' =>'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Enviar', [ 'class'=>'btn btn-primary' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
