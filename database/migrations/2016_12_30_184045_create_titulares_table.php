<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitularesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titulares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->unsignedInteger('dni')->unique();
            $table->string('domicilio');

            $table->integer('id_localidad')->unsigned();
            $table->foreign('id_localidad')
              ->references('id')->on('localidades')
              ->onDelete('restrict')->onUpdate('cascade');

            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('contacto')->nullable();

            $table->unsignedInteger('id_usuario')->default(1)
              ->comment("Referencia al usuario que creó el titular del vehiculo. AKA: los clientes no se comparten");
            $table->foreign('id_usuario')
              ->references('id')->on('users')
              ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('titulares');
    }
}
