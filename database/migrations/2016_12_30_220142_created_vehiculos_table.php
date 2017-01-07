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

            $table->unsignedInteger('id_titular');
            $table->foreign('id_titular')
              ->references('id')->on('titulares')
              ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('id_marca');
            $table->foreign('id_marca')
              ->references('id')->on('marcas_autos')
              ->onUpdate('cascade');

            $table->unsignedInteger('id_modelo');
            $table->foreign('id_modelo')
              ->references('id')->on('modelos_autos')
              ->onUpdate('cascade');

            $table->unsignedInteger('id_usuario')->default(1);
            $table->foreign('id_usuario')
              ->references('id')->on('users')
              ->onUpdate('cascade');

            $table->unsignedInteger('año');
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
