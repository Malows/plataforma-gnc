@extends('layouts.app')

@section('htmlheader_title', trans('message.vehiculos') )
@section('contentheader_title', trans('message.vehiculos') )

@section('leveler')
    <li><a href="{{ route('vehiculos.index') }}"><i class="fa fa-dashboard"></i> {{ trans('message.vehiculos') }}</a></li>
    <li><i class="fa fa-dashboard"></i> {{ trans('message.edit') }}</li>
    <li class="active"> {{ $vehiculo->dominio }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 well">
                {!! Form::open(['route' => ['vehiculos.update', $vehiculo ], 'method' => 'PUT']) !!}
                @include('layouts.partials.flashMessage')
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('titular_id','Titular') !!}
                            {!! Form::select('titular_id', $titulares, $vehiculo->titular_id, ["class"=>"form-control", "placeholder"=>"Seleccione un titular"]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('dominio','Dominio') !!}
                            {!! Form::text('dominio', $vehiculo->dominio, ["class"=>"form-control", "placeholder"=>"Dominio"]) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            {!! Form::label('marca_id', 'Marca') !!}
                            {!! Form::select('marca_id', $marcas, $vehiculo->marca_id, ["class"=>"form-control", 'placeholder' => 'Seleccione una marca']) !!}
                        </div>
                        <div class="col-md-5">
                            {!! Form::label('modelo_id', 'Modelo') !!}
                            {!! Form::select('modelo_id', $modelos, $vehiculo->modelo_id, ["class"=>"form-control", 'placeholder' => 'Seleccione un modelo']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::label('año','Año') !!}
                            {!! Form::number('año', $vehiculo->año, ["class"=>"form-control", "placeholder"=>"Año"]) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::submit('Enviar datos', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2-bootstrap.min.css') }}">
@endsection
@section('extra-scripts')
    <script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/plugins/select2/i18n/es.js') }}"></script>
    <script>
        (function () {

            var marca = $('#marca_id').select2({ language: 'es', theme: "bootstrap"});
            var model_sel = document.getElementById('modelo_id');

            function refillSelectForm( arr ) {
                while ( model_sel.childElementCount )
                    model_sel.removeChild( model_sel.firstChild );

                var placeholder = document.createElement('option');
                placeholder.setAttribute('selected', 'selected');
                placeholder.innerHTML = "Seleccione un modelo";
                model_sel.appendChild( placeholder );

                for ( var i = 0; i < arr.length; i++ ) {
                    var op = document.createElement('option');
                    op.setAttribute('value', arr[i].id);
                    op.innerHTML = arr[i].nombre;
                    model_sel.appendChild( op );
                }
                $("#modelo_id").select2({ language: 'es', theme: "bootstrap"});
            }

            function sendRequest(e) {
                var request = new XMLHttpRequest();
                request.open('GET', 'http://localhost:8000/api/v1/marcas_de_autos/' + e.params.data.id + '/modelos', true);

                request.onload = () => {
                    if (request.status >= 200 && request.status < 400)
                        refillSelectForm(JSON.parse(request.responseText).data.modelos);
                    else
                        console.log('Problems reaching the server and having something different of 200s');
                };
                request.onerror = () => console.log('We can not reach the server, 400s');
                request.send();
            }

            marca.on('select2:select', sendRequest);
            $("#titular_id").select2({ language: 'es', theme: "bootstrap"});
        })();
    </script>
@endsection

