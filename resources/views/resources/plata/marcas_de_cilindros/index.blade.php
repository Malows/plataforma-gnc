@extends('layouts.app')
@section('htmlheader_title', trans('message.marcas_de_cilindros') )
@section('contentheader_title', trans('message.marcas_de_cilindros') )
@section('contentheader_description', 'Lista de marcas de cilindros')

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.marcas_de_cilindros') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row navbar-form">
            <a href="{{ route('marcas_de_cilindros.create') }}" class="btn btn-primary pull-right">Agregar una nueva marca</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.flashMessage')
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Marca de cilindro</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($marcas as $s)
                        <tr>
                            <td>{{$s->nombre}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('marcas_de_cilindros.show', $s) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    @if( Auth::user()->es_admin() or Auth::user()->id == $s->user_id)
                                    <a href="{{ route('marcas_de_cilindros.edit', $s) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-destroy-{{$loop->index}}"><i class="fa fa-trash"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if( Auth::user()->es_admin() or Auth::user()->id == $s->user_id)
            @foreach($marcas as $s)
                <div class="modal fade" id="modal-destroy-{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">
                                    <strong>Borrar una marca de cilindro puede producir daños al sistema.</strong>
                                    <br>
                                    <small>Se notificará a los administradores para que se pongan en contacto y evaluen la eliminación de este recurso</small>
                                </p>
                            </div>
                            <div class="modal-footer">
                                {!! Form::open(['route' => ['marcas_de_cilindros.destroy', $s ], 'method' => 'DELETE']) !!}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                {!! Form::submit('Borrar', ['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="text-center">
            {{ $marcas->links() }}
        </div>
    </div>
@endsection