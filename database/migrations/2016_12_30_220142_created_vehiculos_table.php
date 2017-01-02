<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dominio')->unique();

            $table->integer('id_titular')->unsigned();
            $table->foreign('id_titular')
              ->references('id')->on('titulares')
              ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('id_marca')->unsigned();
            $table->foreign('id_marca')
              ->references('id')->on('marcas_autos')
              ->onUpdate('cascade');

            $table->integer('id_modelo')->unsigned();
            $table->foreign('id_modelo')
              ->references('id')->on('modelos_autos')
              ->onUpdate('cascade');

            $table->integer('id_usuario')->unsigned()->default(1);
            $table->foreign('id_usuario')
              ->references('id')->on('users')
              ->onDelete('set default')->onUpdate('cascade');

            $table->integer('año')->unsigned();
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
        Schema::dropIfExists('vehiculos');
    }
}
