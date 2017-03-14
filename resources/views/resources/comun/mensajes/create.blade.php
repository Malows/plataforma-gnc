@extends('layouts.app')

@section('htmlheader_title', trans('message.mensajes') )
@section('contentheader_title', trans('message.mensajes') )

@section('leveler')
    <li class="active"><a href="{{ route('mensajes.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.mensajes') }}</a></li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 well">

                {!! Form::open(['route' => ['mensajes.store' ], 'method' => 'POST']) !!}
                <h3>Escribenos tu mensaje</h3>
                @include('layouts.partials.flashMessage')
                <div class="form-group">
                    {!! Form::select('to_id', $usuarios_disponibles, null, ['class' =>'form-control','placeholder'=>'Elija un destinatario']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('asunto', null, ['class' =>'form-control','placeholder'=>'Asunto']) !!}
                </div>
                <div class="form-group">
                    {!! Form::textarea('mensaje', null, ["class"=>"form-control", "placeholder"=>"Escriba su mensaje"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Enviar mensaje', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('extra-styles')
    <link rel="stylesheet" href="{{ asset('plugins/trumbowyg/ui/trumbowyg.min.css') }}">
@endsection

@section('extra-scripts')
    <script src="{{ asset('plugins/trumbowyg/trumbowyg.min.js') }}"></script>
    <script src="{{ asset('plugins/trumbowyg/langs/es_ar.min.js') }}"></script>
    <script>
        (function () {
            $('textarea').trumbowyg({
                lang:'es_ar'
            });
        })();
    </script>
@endsection