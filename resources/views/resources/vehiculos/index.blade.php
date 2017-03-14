@extends('layouts.app')

@section('htmlheader_title', trans('message.vehiculos') )
@section('contentheader_title', trans('message.vehiculos') )
@section('contentheader_description', 'Vehículos registrados')

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.vehiculos') }}</li>
@endsection

@section('main-content')

    <div class="container-fluid spark-screen">
        <div class="row navbar-form ">
            <a href="{{ route('vehiculos.create') }}" class="btn btn-primary pull-right">Agregar vehiculo</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.flashMessage')
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Dominio</th>
                        <th>Titular</th>
                        <th>Modelo</th>
                        <th>Opciones</th>
                        @if( Auth::user()->es_admin() )<th>Admin Ops</th>@endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vehiculos as $vehiculo)
                        <tr>
                            <td>{{ $vehiculo->dominio }}</td>
                            <td><a href="{{ route('titulares.show', $vehiculo->titular) }}">{{ $vehiculo->titular->apellido.', '.$vehiculo->titular->nombre }}</a></td>
                            <td>{{ $vehiculo->marca->nombre.' '.$vehiculo->modelo->nombre." - $vehiculo->año"}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('vehiculos.show', $vehiculo) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <button type="button" class="btn btn-primary{{$vehiculo->deleted_at ? " disabled": ""}}" data-toggle="modal" data-target="#modal-destroy-{{$loop->index}}"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                            @if( Auth::user()->es_admin() )
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-{{ $vehiculo->deleted_at ? "info" : "danger disabled" }}" data-toggle="modal" data-target="#modal-restore-{{$loop->index}}"><i class="fa fa-undo"></i></button>
                                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modal-erase-{{$loop->index}}"><i class="fa fa-eraser"></i></button>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="align-center">
            {{ $vehiculos->links() }}
        </div>
        @foreach($vehiculos as $vehiculo)
            <div class="modal fade" id="modal-destroy-{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">
                                <strong>Borrar un titular también conlleva el borrado de todos los vehículos registrados a nombre de este.</strong>
                                <br>
                                <small>Este proceso puede deshacerse, si así lo desea, emita un ticket a cualquier administrador explicando la situación</small>
                            </p>
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['route' => ['vehiculos.destroy', $vehiculo ], 'method' => 'DELETE']) !!}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                {!! Form::submit('Borrar', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            @if( Auth::user()->es_admin() )
                <div class="modal fade" id="modal-restore-{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog  modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                                <p>Restaurar el vehículo borrado</p>
                            </div>
                            <div class="modal-footer">
                                {!! Form::open(['route' => ['vehiculos.restore', $vehiculo ], 'method' => 'PUT']) !!}
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    {!! Form::submit('Restaurar elemento', ['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-erase-{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog  modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                                <p>Eliminar permanentemente el vehículo</p>
                            </div>
                            <div class="modal-footer">
                                {!! Form::open(['route' => ['vehiculos.erase', $vehiculo ], 'method' => 'DELETE']) !!}
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    {!! Form::submit('Eliminar elemento', ['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
