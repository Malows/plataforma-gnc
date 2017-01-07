@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('message.usuarios') }}
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {{--<div class="col-md-12">--}}
                <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Tipo de usuario</th>
                        <th>Fecha de registro</th>
                        <th>Fin de licencia</th>
                        <th>Habilitado</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            {{--{{dd($usuario->tipo_de_usuario)}}--}}
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->id_tipo_usuario->nombre }}</td>
                            <td>{{ $usuario->fecha_de_licencia }}</td>
                            <td>{{ $usuario->duracion_de_licencia }}</td>
                            <td>{{ $usuario->habilitado }}</td>
                            <td>opciones</td>
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
