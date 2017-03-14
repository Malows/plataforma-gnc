@extends('layouts.app')
@section('htmlheader_title',trans('message.trabajos_de_taller'))
@section('contentheader_title',trans('message.trabajos_de_taller'))
@section('contentheader_description','Lista de trabajos realizados y pendientes')

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.trabajos_de_taller') }}</li>
@endsection

@section('main-content')

    <div class="container-fluid spark-screen">
        <div class="row navbar-form">
            <a href="{{ route('trabajos_de_taller.create') }}" class="btn btn-primary pull-right">Agregar un nuevo trabajo</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.flashMessage')
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Vehículo</th>
                        <th>Servicio</th>
                        <th>Estado</th>
                        <th> </th>

                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $trabajos as $t )
                        <tr>
                            <td>{{ $t->vehiculo->dominio }}</td>
                            <td>{{ $servicios[$t->servicio_de_taller_id] }}</td>
                            <td>{{ "Estado: $t->estado" }}</td>
                            <td>
                                <div class="progress" style="width: 20em;">
                                    @if( $t->estado == 'No ingresado')
                                        <div class="progress-bar progress-bar-danger" style="width: 10%">
                                            <span class="sr-only">Ingresado</span>
                                        </div>
                                    @elseif( $t->estado == 'Por revisar')
                                        <div class="progress-bar progress-bar-danger progress-bar-striped active" style="width: 20%">
                                            <span class="sr-only">Por revisar</span>
                                        </div>
                                    @elseif( $t->estado == 'En proceso')
                                        <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 60%">
                                            <span class="sr-only">En proceso</span>
                                        </div>
                                    @elseif( $t->estado == 'Finalizado')
                                        <div class="progress-bar progress-bar-info" style="width: 90%">
                                            <span class="sr-only">Finalizado</span>
                                        </div>
                                    @elseif( $t->estado == 'Retirado' )
                                        <div class="progress-bar progress-bar-success" style="width: 100%">
                                            <span class="sr-only">Finalizado</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('trabajos_de_taller.advance', $t) }}" class="btn btn-info"><i class="fa fa-forward"></i> Avanzar estado</a>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('trabajos_de_taller.show', $t) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('trabajos_de_taller.edit', $t) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-destroy-{{$loop->index}}"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="align-center">
        {{ $trabajos->links() }}
    </div>
    @foreach($trabajos as $s)
        <div class="modal fade" id="modal-destroy-{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            Borrar un trabajo de taller es una operación irreversible.
                            <strong class="text-danger">No se puede deshacer esta acción. ¿Estás realmente seguro de querer borrarlo?</strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                        {!! Form::open(['route' => ['servicios_de_taller.destroy', $s ], 'method' => 'DELETE']) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
