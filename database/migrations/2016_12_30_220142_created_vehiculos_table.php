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

            $table->unsignedInteger('titular_id');
            $table->foreign('titular_id')
              ->references('id')->on('titulares')
              ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('marca_id');
            $table->foreign('marca_id')
                ->references('id')->on('marcas_autos')
                ->onUpdate('cascade');

            $table->unsignedInteger('modelo_id');
            $table->foreign('modelo_id')
              ->references('id')->on('modelos_autos')
              ->onUpdate('cascade');

            $table->unsignedInteger('user_id')->default(1);
            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('set default')->onUpdate('cascade');

            $table->unsignedInteger('año');
            $table->timestamps();
            $table->softDeletes();
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
