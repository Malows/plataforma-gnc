@extends('layouts.app')

@section('htmlheader_title', trans('message.provincias') )
@section('contentheader_title', trans('message.provincias') )

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.provincias') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <hr>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.flashMessage')
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Provincia</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($provincias as $prov)
                        <tr>
                            <td>{{ $prov->id }}</td>
                            <td><a href="{{ route('localidades.index', $prov) }}" >{{ $prov->nombre }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
