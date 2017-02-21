@extends('layouts.app')

@section('htmlheader_title', trans('message.titulares') )
@section('contentheader_title', trans('message.titulares') )
@section('contentheader_description', 'Titulares de vehículos registrados')

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.titulares') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row navbar-form ">
            <a href="{{ route('titulares.create') }}" class="btn btn-primary pull-right">Agregar titular</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.flashMessage')
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nombre y Apellido</th>
                        <th>DNI</th>
                        <th>Direccion</th>
                        <th>Teléfono</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($titulares as $titular)
                        <tr>
                            <td><a href="{{ route('titulares.show', $titular) }}">{{ "$titular->apellido, $titular->nombre" }}</a></td>
                            <td>{{ $titular->dni }}</td>
                            <td>{{ $titular->domicilio }}</td>
                            <td>{{ ($titular->telefono) ? $titular->telefono : "" }}</td>
                            <td>
                                <a href="{{ route('titulares.edit', $titular) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('titulares.delete', $titular) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="align-center">
            {{ $titulares->links() }}
        </div>
    </div>
@endsection
