@extends('layouts.app')
@section('htmlheader_title',trans('message.trabajos_de_taller'))
@section('contentheader_title',trans('message.trabajos_de_taller'))
@section('contentheader_description','Editar un trabajo existente')

@section('leveler')
    <li><i class="fa fa-dashboard"></i> {{ trans('message.trabajos_de_taller') }}</li>
    <li class="active">{{ trans('message.create') }}</li>

@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <hr>
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                {!! Form::open(['route' => ['trabajos_de_taller.update', $trabajo], 'method' => 'PUT']) !!}

                <div class="row form-group">
                    <div class="col-md-6">
                        {!! Form::label('titular', 'Nombre del titular') !!}
                        {!! Form::select('titular', $titulares, $trabajo->vehiculo->titular_id, ['placeholder' => 'Seleccione un titular', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('vehiculo_id', 'Vehiculo') !!}
                        {!! Form::select('vehiculo_id', $vehiculos, $trabajo->vehiculo->id, ['placeholder' => 'Seleccione un vehículo', 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        {!! Form::label('servicio_de_taller_id', 'Servicio') !!}
                        {!! Form::select('servicio_de_taller_id', $servicios, $trabajo->servicio_de_taller_id, ['placeholder' => 'Ingrese un servicio', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('fecha_de_turno', 'Fecha de ingreso') !!}
                        <div class="input-group">
                            <span class="input-group-addon" id="set-now-button" title="Ingresar fecha de hoy"><i class="fa fa-clock-o"></i></span>
                            {!! Form::text('fecha_de_turno', $trabajo->fecha_de_turno, ['placeholder' => 'YYYY-MM-DD hh:mm:ss', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        {!! Form::label('estado', 'Estado') !!}
                        {!! Form::select('estado', ['No ingresado'=>'No ingresado','Por revisar'=>'Por revisar','En proceso'=>'En proceso','Finalizado'=>'Finalizado', 'Retirado'=>'Retirado'], $trabajo->estado, ['placeholder' => 'Seleccione un estado', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                    </div>
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
            var vehiculos = document.getElementById('vehiculo_id');

            var titular = $('#titular').select2({ language: 'es', theme: "bootstrap" });

            function refillSelectForm( arr ) {
                while ( vehiculos.childElementCount )
                    vehiculos.removeChild( vehiculos.firstChild );

                var placeholder = document.createElement('option');
                placeholder.setAttribute('selected', 'selected');
                placeholder.innerHTML = "Seleccione un vehículo";
                vehiculos.appendChild( placeholder );

                for ( var i = 0; i < arr.length; i++ ) {
                    var op = document.createElement('option');
                    op.setAttribute('value', arr[i].id);
                    op.innerHTML = arr[i].nombre;
                    vehiculos.appendChild( op );
                }
            }

            function sendVehiculosRequest(e) {
                console.log('Empiezo el request');
                var url = 'http://localhost:8000/api/v1/vehiculos/?user={{Auth::user()->id}}&titular=' + e.params.data.id;
                console.log(url);
                var request = new XMLHttpRequest();
                request.open('GET', url, true);

                request.onload = () => {
                    if (request.status >= 200 && request.status < 400) {
                        console.log(JSON.parse(request.responseText));
                        refillSelectForm(JSON.parse(request.responseText).data.vehiculos);
                    } else
                        console.log('Problems reaching the server and having something different of 200s');
                };
                request.onerror = () => console.log('We can not reach the server, 400s');
                request.send();
            }

            titular.on('select2:select', sendVehiculosRequest);

            var now_button = document.getElementById('set-now-button');
            now_button.addEventListener('click', () => {
                let today = new Date();
                let fecha = today.getFullYear()+'-';

                fecha += today.getMonth() < 9 ? '0': '';
                fecha += (today.getMonth()+1)+'-';

                fecha += today.getDate() < 10 ? '0': '';
                fecha += today.getDate()+' ';

                fecha += today.getHours() < 10 ? '0': '';
                fecha += today.getHours()+':';

                fecha += today.getMinutes() < 10 ? '0': '';
                fecha += today.getMinutes()+':';

                fecha += today.getSeconds() < 10 ? '0' : '';
                fecha += today.getSeconds();
                console.log(fecha);
                document.querySelector('#fecha_de_turno').value = fecha;
            });

            document.addEventListener('load', () => {

            });
        })();
    </script>
@endsection