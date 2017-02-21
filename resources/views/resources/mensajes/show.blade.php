@extends('layouts.app')

@section('htmlheader_title', trans('message.mensajes') )
@section('contentheader_title', trans('message.mensajes') )

@section('leveler')
    <li class="active"><a href="{{ route('mensajes.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.mensajes') }}</a></li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row navbar-form navbar-right">
            <div>
            {!! Form::open(['route' => ['mensajes.marcar_no_leido', $mensaje], 'method' => 'PUT' ]) !!}
            {!! Form::submit('Marcar como no leido', [ 'class'=>'btn btn-primary' ]) !!}
            {!! Form::close() !!}
            </div>
            <div>
            {!! Form::open(['route' => ['mensajes.destroy', $mensaje], 'method' => 'DELETE' ]) !!}
            {!! Form::submit('Eliminar', [ 'class'=>'btn btn-primary' ]) !!}
            {!! Form::close() !!}
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="message-box">
                <h3>{{ $mensaje->from->name }} <img src="{{ Gravatar::get($mensaje->from->email) }}" class="img-circle" alt="User Image"/></h3>
                <h2>{{ $mensaje->asunto }}</h2>
                <p>
                    <div class="message-body">
                        {!! $mensaje->mensaje !!}
                    </div>
                    <hr>
                    <small>{{ $mensaje->created_at->format('Y/m/d H:i') }} - {{ $mensaje->created_at->diffForHumans() }}</small>
                </p>

            </div>
        </div>
    </div>
@endsection