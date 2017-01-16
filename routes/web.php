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

        Route::get('/', function (){ return view('home'); })->name('dashboard');

        Route::group(['middleware' => 'permisos.admin'], function (){
            Route::resource('/provincias',          'ProvinciaController');

            Route::resource('/localidades',         'LocalidadController');

            Route::resource('/tipo_de_usuarios',    'TipoUsuarioController');

            Route::resource('/usuarios',            'UserController');

            Route::get('/tipo_de_usuarios/{tipo_de_usuario}/delete', ['uses'=>'TipoUsuarioController@delete', 'as'=>'tipo_de_usuarios.delete']);
            Route::get('/usuarios/{usuario}/delete', ['uses'=>'UserController@delete', 'as'=>'usuarios.delete']);
        });

        Route::group(['middleware' => 'permisos.bronce'],function (){
            Route::resource('/vehiculos',           'VehiculoController');
            Route::resource('/titulares',           'TitularController');
            Route::resource('/marcas_de_autos',     'MarcaAutosController');
            Route::resource('/modelos_de_autos',    'ModeloAutosController');
        });

    });
});
