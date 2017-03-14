@extends('layouts.app')

@section('htmlheader_title', trans('message.modelos_de_autos') )
@section('contentheader_title', trans('message.modelos_de_autos') )
@section('contentheader_description', 'Modelos de frabricantes de autos registrados')

@section('leveler')
    <li ><i class="fa fa-dashboard"></i> <a href="{{ route('marcas_de_autos.index') }}">{{ trans('message.marcas_de_autos') }}</a></li>
    <li>{{ $marca->nombre }}</li>
    <li class="active">{{ trans('message.modelos_de_autos') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row navbar-form ">
            <a href="{{ route('modelos_de_autos.create', $marca) }}" class="btn btn-primary pull-right">Agregar un modelo de auto</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.flashMessage')
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modelos_propios as $modelo)
                        <tr>
                            <td>{{ $marca->nombre }}</td>
                            <td>{{ $modelo->nombre }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('modelos_de_autos.edit', ['marcas_de_auto'=>$marca,'mopdelos_de_auto' =>$modelo]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('modelos_de_autos.delete', ['marcas_de_auto'=>$marca,'mopdelos_de_auto' =>$modelo]) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @foreach($modelos_ajenos as $modelo)
                        <tr>
                            <td>{{ $marca->nombre }}</td>
                            <td>{{ $modelo->nombre }}</td>
                            <td>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
