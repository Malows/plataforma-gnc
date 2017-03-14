@extends('layouts.app')

@section('htmlheader_title', trans('message.tipo_de_usuarios') )
@section('contentheader_title', trans('message.tipo_de_usuarios') )
@section('contentheader_description', 'Es una mala idea andar por acá')

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.tipo_de_usuarios') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <a href="{{ route('tipo_de_usuarios.create') }}" class="btn btn-primary pull-right">Crear un tipo de usuario nuevo</a>
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
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tipos_usuarios as $tipo)
                        <tr>
                            <td>{{ $tipo->id }}</td>
                            <td>{{ $tipo->nombre }}</td>
                            <td>
                                <a href="{{ route('tipo_de_usuarios.edit', $tipo->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
