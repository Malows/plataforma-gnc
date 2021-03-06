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

            $table->unsignedInteger('marca_autos_id');
            $table->foreign('marca_autos_id')
              ->references('id')->on('marcas_autos')
              ->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedInteger('user_id')->default(1)
            ->comment("Quien registró el modelo de autos, si fletamos usuario, nos quedamos con sus datos");
            $table->foreign('user_id')
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
