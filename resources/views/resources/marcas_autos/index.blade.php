@extends('layouts.app')

@section('htmlheader_title', trans('message.marcas_de_autos') )
@section('contentheader_title', trans('message.marcas_de_autos') )
@section('contentheader_description', 'Marcas de autos registrados')

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.marcas_de_autos') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row navbar-form ">
            <a href="{{ route('marcas_de_autos.create') }}" class="btn btn-primary pull-right">Agregar una marca de auto</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.flashMessage')
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($marcas_propias as $marca)
                        <tr>
                            <td><a href="{{ route('modelos_de_autos.index', $marca) }}">{{ $marca->nombre }}</a></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('marcas_de_autos.edit', $marca) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('marcas_de_autos.delete', $marca) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @foreach($marcas_ajenas as $marca)
                        <tr>
                            <td><a href="{{ route('modelos_de_autos.index', $marca) }}">{{ $marca->nombre }}</a></td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
