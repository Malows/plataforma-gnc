@extends('layouts.app')

@section('htmlheader_title', trans('message.usuarios') )
@section('contentheader_title', trans('message.usuarios') )

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.usuarios') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary pull-right">Crear un usuario nuevo</a>
        </div>
        <hr>
        <div class="row">
            {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="col-md-12">
                @include('layouts.partials.flashMessage')
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tipo de usuario</th>
                            <th>Fecha de registro</th>
                            <th>Fin de licencia</th>
                            <th>Habilitado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->tipo_usuario->nombre }}</td>
                            <td>{{ $usuario->inicio->format('d/m/Y') }}</td>
                            <td>{{ $usuario->fin->format('d/m/Y').' - '. $usuario->diferencia}}</td>
                            <td><i class="fa fa-@if ($usuario->habilitado ){{"check"}}@else{{"times"}}@endif"></i></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('usuarios.delete', $usuario->id  ) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="align-center">
            {!! $usuarios->render() !!}
        </div>
    </div>
@endsection
