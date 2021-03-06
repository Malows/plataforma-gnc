<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

    Route::group(['prefix'=> 'dashboard'], function (){ //example.com/dashboard/

        Route::get('/', 'HomeController@index')->name('dashboard');

        Route::group(['middleware' => 'permisos.admin'], function (){
            Route::resource('/tipo_de_usuarios',    'TipoUsuarioController');
            Route::resource('/usuarios',            'UserController');

            Route::get('/tipo_de_usuarios/{tipo_de_usuario}/delete', ['uses'=>'TipoUsuarioController@delete', 'as'=>'tipo_de_usuarios.delete']);
            Route::get('/usuarios/{usuario}/delete', ['uses'=>'UserController@delete', 'as'=>'usuarios.delete']);

            Route::delete('/titulares/{titular}/erase', ['uses' => 'TitularController@erase', 'as' =>'titulares.erase']);
            Route::put('/titulares/{titular}/restore', ['uses' => 'TitularController@restore', 'as' => 'titulares.restore']);

            Route::delete('/vehiculos/{vehiculo}/erase',['uses' => 'VehiculoController@erase', 'as' => 'vehiculos.erase']);
            Route::put('/vehiculos/{vehiculo}/restore',['uses' => 'VehiculoController@restore', 'as' => 'vehiculos.restore']);
        });

        Route::group(['middleware' => 'permisos.bronce'],function (){
            Route::resource('/provincias',          'ProvinciaController');
            Route::resource('/provincias/{provincia}/localidades',         'LocalidadController');
            Route::resource('/vehiculos',           'VehiculoController');
            Route::resource('/titulares',           'TitularController');
            Route::resource('/marcas_de_autos',     'MarcaAutosController');
            Route::resource('/marcas_de_autos/{marcas_de_auto}/modelos_de_autos',    'ModeloAutosController');

            Route::get('/provincias/{provincia}/localidades/{localidade}/delete', ['uses'=>'LocalidadController@delete','as'=>'localidades.delete']);
            Route::get('/marcas_de_autos/{marcas_de_auto}/delete', ['uses' => 'MarcaAutosController@delete', 'as'=>'marcas_de_autos.delete']);
            Route::get('/marcas_de_autos/{marcas_de_auto}/modelos_de_autos/{modelos_de_auto}/delete', ['uses' => 'ModeloAutosController@delete', 'as'=>'modelos_de_autos.delete']);
        });

        Route::group(['middleware' => 'permisos.plata'], function (){
            Route::resource('/servicios_de_taller', 'ServicioDeTallerController');
            Route::resource('/trabajos_de_taller', 'TrabajoDeTallerController');
            Route::get('trabajos_de_taller/{id}/advance', ['uses' => 'TrabajoDeTallerController@advance', 'as' => 'trabajos_de_taller.advance']);
            Route::resource('/marcas_de_cilindros', 'MarcaCilindroController');
            Route::resource('/datos_de_cilindros','DatosCilindroController');
            Route::resource('/cilindros', 'CilindroController');
        });

        Route::resource('/tickets',             'TicketController');
        Route::resource('/mensajes',            'MensajeController');
        Route::put('/mensajes/{mensaje}/no_leido', 'MensajeController@marcar_no_leido')->name('mensajes.marcar_no_leido');


    });

    Route::get('/base_de_conocimientos', function (){
        return View('');
    })->name('base_de_conocimientos');

    Route::group(['prefix' => 'api/v1/'], function (){
        Route::get('/provincias/{provincia}/localidades/', ['uses'=>'LocalidadController@api_index','as'=>'api.localidades.index']);
        Route::get('/marcas_de_autos/{marca}/modelos/', ['uses' => 'ModeloAutosController@api_index', 'as' =>'api.modelos_autos.index']);
        Route::get('/titulares/', ['uses' => 'TitularController@api_index', 'as' => 'api.titulares.index']);
        Route::get('/vehiculos/', ['uses' => 'VehiculoController@api_index', 'as' => 'api.vehiculoss.index']);
    });
});

Route::get('precios', function (){
    return view('');
})->name('precios');
Route::get('preguntas_frecuentes', function () {
    return view('');
})->name('faq');
