@extends('layouts.app')
@section('htmlheader_title', trans('message.servicios_de_taller') )
@section('contentheader_title', trans('message.servicios_de_taller') )
@section('contentheader_description', 'Lista de posibles servicios que brinda su taller')

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.servicios_de_taller') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row navbar-form">
            <a href="{{ route('servicios_de_taller.create') }}" class="btn btn-primary pull-right">Agregar un nuevo servicio</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.flashMessage')
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($servicios_propios as $s)
                        <tr>
                            <td>{{$s->nombre}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('servicios_de_taller.show', $s) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('servicios_de_taller.edit', $s) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-destroy-{{$loop->index}}"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if( ! Auth::user()->es_admin() )
                        @foreach($servicios_ajenos as $s)
                        <tr>
                            <td>{{$s->nombre}}</td>
                            <td>
                                <a href="{{ route('servicios_de_taller.show', $s) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        @foreach($servicios_propios as $s)
            <div class="modal fade" id="modal-destroy-{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">
                                <strong>Borrar un servicio de taller puede producir daños al sistema.</strong>
                                <br>
                                <small>Se notificara a los administradores para que se pongan en contacto y evaluen la eliminación del servicio</small>
                            </p>
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['route' => ['servicios_de_taller.destroy', $s ], 'method' => 'DELETE']) !!}
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            {!! Form::submit('Borrar', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection