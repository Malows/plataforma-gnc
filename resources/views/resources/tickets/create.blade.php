@extends('layouts.app')

@section('htmlheader_title', trans('message.tickets'). ' de ayuda' )
@section('contentheader_title', trans('message.tickets'). ' de ayuda' )

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.tickets') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 well">

                {!! Form::open(['route' => ['tickets.store' ], 'method' => 'POST']) !!}
                <h3>Escribenos tu mensaje</h3>
                @include('layouts.partials.flashMessage')
                <div class="form-group">
                    {!! Form::textarea('mensaje', null, ["class"=>"form-control", "placeholder"=>"Describa su problema aquí"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Enviar ticket', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
                <hr>
                <p class="text-muted">
                    Todos los tickets se notifican personalmente a los administradores a traves de alertas móviles. Estas dependen del plan contratadp y si su cuenta tiene o no habilitado el servicio de alerta inmediata.
                    <br>
                    Para obtener información acerca de los horarios de notificación, el servicio de alerta inmediata y detalles de los servicios brindados por la plataforma, puede dirigirse a las Preguntas frecuentes
                    <a href="#" title="Preguntas frecuentes">FAQ</a>
                </p>
            </div>
        </div>
    </div>
@endsection