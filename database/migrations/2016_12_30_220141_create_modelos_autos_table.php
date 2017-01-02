<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelosAutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelos_autos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');

            $table->integer('id_marca')->unsigned();
            $table->foreign('id_marca')
              ->references('id')->on('marcas_autos')
              onDelete('restrict')->onUpdate('cascade');

            $table->integer('id_usuario')->nullable()->default(1)
            ->comment("Quien registró el modelo de autos, si fletamos usuario, nos quedamos con sus datos");
            $table->foreign('id_usuario')
            ->references('id')->on('users')
            ->onDelete('set default')->onUpdate('cascade');

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
        Schema::dropIfExists('modelos_autos');
    }
}
