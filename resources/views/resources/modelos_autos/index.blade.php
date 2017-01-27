@extends('layouts.app')

@section('htmlheader_title', trans('message.modelos_de_autos') )
@section('contentheader_title', trans('message.modelos_de_autos') )
@section('contentheader_description', 'Modelos de frabricantes de autos registrados')

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.modelos_de_autos') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row navbar-form ">
            <a href="{{ route('marcas_de_autos.create') }}" class="btn btn-primary pull-right">Agregar una marca de auto</a>
            <a href="{{ route('modelos_de_autos.create') }}" class="btn btn-primary pull-right">Agregar un modelo de auto</a>
            {{--{!! Form::open(['route' => 'localidades.index', 'method' => 'GET', 'class' => 'pull-left']) !!}--}}
            {{--{!! Form::select('provincia', $provincias, (isset($provincia_filtro) ? $provincia_filtro : '0'),['class' => 'form-control']) !!}--}}
            {{--{!! Form::text('codigo_postal', null, ['class'=> 'form-control', 'placeholder' => 'Código postal']) !!}--}}
            {{--<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>--}}
            {{--{!! Form::close() !!}--}}
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
                            <td>{{ $modelo->marca->nombre }}</td>
                            <td>{{ $modelo->nombre }}</td>
                            <td>
                                <a href="{{ route('modelos_de_autos.edit', $modelo) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('modelos_de_autos.delete', $modelo) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    @foreach($modelos_ajenos as $modelo)
                        <tr>
                            <td>{{ $modelo->marca->nombre }}</td>
                            <td>{{ $modelo->nombre }}</td>
                            <td>
                                @if(Auth::user()->tipo_usuario_id === 1)
                                    <a href="{{ route('modelos_de_autos.edit', $modelo) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('modelos_de_autos.delete', $modelo) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
