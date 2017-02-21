@extends('layouts.app')

@section('htmlheader_title', trans('message.localidades') )
@section('contentheader_title', trans('message.localidades') )

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> <a href="{{ route('provincias.index') }}">{{ trans('message.provincias') }}</a></li>
    <li> <a href="{{ route('localidades.index', $provincia) }}">{{$provincia->nombre}}</a></li>
    <li> {{ trans('message.localidades') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row navbar-form ">
            <a href="{{ route('localidades.create', $provincia) }}" class="btn btn-primary pull-right">Crear un localidad nueva</a>
            {!! Form::text('codigo_postal', null, ['class'=> 'form-control pull-left', 'placeholder' => 'Código postal']) !!}
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.flashMessage')
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Código postal</th>
                        <th>Provincia</th>
                        <th>Localidad</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($localidades as $loc)
                        <tr>
                            <td>{{ $loc->codigo_postal }}</td>
                            <td>{{ $provincia->nombre }}</td>
                            <td>{{ $loc->nombre }}</td>
                            <td>
                                <a href="{{ route('localidades.show', ['provincia' => $provincia, 'localidade' => $loc]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                @if(Auth::user()->es_admin())
                                    <a href="{{ route('localidades.edit', ['provincia' => $provincia, 'localidade' => $loc]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('localidades.delete', ['provincia' => $provincia, 'localidade' => $loc]) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
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
