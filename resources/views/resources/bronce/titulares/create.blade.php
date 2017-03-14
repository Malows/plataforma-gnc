@extends('layouts.app')

@section('htmlheader_title', trans('message.titulares') )
@section('contentheader_title', trans('message.titulares') )

@section('leveler')
    <li class="active"><i class="fa fa-dashboard"></i> {{ trans('message.titulares') }}</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 well">

                {!! Form::open(['route' => ['titulares.store' ], 'method' => 'POST']) !!}
                @include('layouts.partials.flashMessage')
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('nombre','Nombre') !!}
                            {!! Form::text('nombre', null, ["class"=>"form-control", "placeholder"=>"Nombre"]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('apellido','Apellido') !!}
                            {!! Form::text('apellido', null, ["class"=>"form-control", "placeholder"=>"Apellido"]) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('dni','DNI') !!}
                            {!! Form::text('dni', null, ["class"=>"form-control", "placeholder"=>"DNI"]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('telefono','Teléfono') !!}
                            {!! Form::text('telefono', null, ["class"=>"form-control", "placeholder"=>"Teléfono"]) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('provincia', 'Provincia') !!}
                            {!! Form::select('provincia', $provincias, null, ["class"=>"form-control", 'placeholder' => 'Seleccione una provincia']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('localidad_id', 'Localidad') !!}
                            {!! Form::select('localidad_id', [], null, ["class"=>"form-control", 'placeholder' => 'Seleccione una localidad']) !!}
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('domicilio','Domicilio') !!}
                            {!! Form::text('domicilio', null, ["class"=>"form-control", "placeholder"=>"Domicilio"]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('email','Email') !!}
                            {!! Form::text('email', null, ["class"=>"form-control", "placeholder"=>"Email"]) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('contacto','Contacto') !!}
                            {!! Form::text('contacto', null, ["class"=>"form-control", "placeholder"=>"Información adicional"]) !!}
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
        var prov = document.getElementById('provincia');
        var loc_sel = document.getElementById('localidad_id');

        function refillSelectForm( arr ) {
            while ( loc_sel.childElementCount )
                loc_sel.removeChild( loc_sel.firstChild );

            var placeholder = document.createElement('option');
            placeholder.setAttribute('selected', 'selected');
            placeholder.innerHTML = "Seleccione una localidad";
            loc_sel.appendChild( placeholder );

            for ( var i = 0; i < arr.length; i++ ) {
                var op = document.createElement('option');
                op.setAttribute('value', arr[i].id);
                op.innerHTML = arr[i].nombre;
                loc_sel.appendChild( op );
            }
            $("#localidad_id").select2({ language: 'es', theme: "bootstrap"});
        }

        function sendRequest() {
            var request = new XMLHttpRequest();
            request.open('GET', 'http://localhost:8000/api/v1/provincias/' + prov.options[prov.selectedIndex].value + '/localidades', true);

            request.onload = () => {
                if (request.status >= 200 && request.status < 400)
                    refillSelectForm( JSON.parse( request.responseText ).data.localidades );
                else
                    console.log('Problems reaching the server and having something different of 200s');
            };
            request.onerror = () => console.log('We can not reach the server, 400s');
            request.send();
        }

        prov.addEventListener('change', sendRequest);
    })();
</script>
@endsection