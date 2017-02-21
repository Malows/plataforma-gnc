@extends('layouts.app')

@section('htmlheader_title', trans('message.mensajes') )
@section('contentheader_title', trans('message.mensajes') )
@section('contentheader_description', 'Mensajes recibidos')

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.mensajes') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row navbar-form ">
            <a href="{{ route('mensajes.create') }}" class="btn btn-primary pull-right">Nuevo mensaje</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.flashMessage')
                @if( $mensajes->count() )
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>De</th>
                        <th>Asunto</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mensajes as $msg)
                        <tr>
                            @if(!boolval($msg->leido))
                                <td><strong>{{ $msg->from->name }}</strong></td>
                                <td><strong>{{ $msg->asunto }}</strong></td>
                            @else
                                <td>{{ $msg->from->name }}</td>
                                <td>{{ $msg->asunto }}</td>
                            @endif
                            <td><a href="{{ route('mensajes.show', $msg) }}" class="btn btn-primary pull-right"><i class="fa fa-eye" title="Ver mensaje"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <p class="text-muted" style="margin: 5em auto; text-align: center;">No hay mensajes en tu bandeja de entrada.</p>
                @endif
            </div>
        </div>
    </div>
    {{--<script>--}}
        {{--(function () {--}}
            {{--var select_todo = document.getElementById('select_all_checkbox');--}}
            {{--var individuales = document.querySelectorAll('table > tbody > a > td > input');--}}

            {{--function TodosLosMensajes ( arr_nodos, val ) {--}}
                {{--arr_nodos.map( (x) => {x.checked = val;} )--}}
                {{--if ( val ) console.log('seleccioné todos');--}}
                {{--else  console.log('deseleccioné todos');--}}
            {{--}--}}

            {{--function all ( arr_nodo ) {--}}
                {{--return arr_nodo.reduce( ( a, b ) => a && b , true );--}}
            {{--}--}}

            {{--function toqueUno ( nodo ) {--}}
                {{--if ( nodo.checked === false ) {--}}
                    {{--select_todo.checked = false;--}}
                {{--} else {--}}
                    {{--if ( all( individuales ) ) {--}}
                        {{--select_todo.checked = true;--}}
                    {{--}--}}
                {{--}--}}
            {{--}--}}

            {{--function toqueElTodos () {--}}
                {{--if ( ! individuales.length ) console.log('No tenes mensajes');--}}
                {{--else TodosLosMensajes( inviduales, select_todo.checked );--}}
            {{--}--}}
        {{--})();--}}
    {{--</script>--}}
@endsection
