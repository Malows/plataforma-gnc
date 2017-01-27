@extends('layouts.app')

@section('htmlheader_title', trans('message.localidades') )
@section('contentheader_title', trans('message.localidades') )

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.localidades') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row navbar-form ">
            <a href="{{ route('localidades.create') }}" class="btn btn-primary pull-right">Crear un localidad nueva</a>
            {!! Form::open(['route' => 'localidades.index', 'method' => 'GET', 'class' => 'pull-left']) !!}
                {!! Form::select('provincia', $provincias, (isset($provincia_filtro) ? $provincia_filtro : '0'),['class' => 'form-control']) !!}
                {!! Form::text('codigo_postal', null, ['class'=> 'form-control', 'placeholder' => 'Código postal']) !!}
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
            {!! Form::close() !!}

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
                            <td>{{ $loc->provincia->nombre }}</td>
                            <td>{{ $loc->nombre }}</td>
                            <td>
                                <a href="{{ route('tipo_de_usuarios.show', $loc) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                @if(Auth::user()->tipo_usuario_id === 1)
                                    <a href="{{ route('tipo_de_usuarios.edit', $loc) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('tipo_de_usuarios.delete', $loc) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="align-center">
            @if( isset($provincia_filtro) )
                {!! $localidades->appends(['provincia' => $provincia_filtro])->links() !!}
            @else
                {!! $localidades->links() !!}
            @endif
        </div>
    </div>
@endsection
