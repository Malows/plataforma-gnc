<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDatosCilindros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_cilindros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_homologado');

            $table->unsignedInteger('marca_cilindro_id')->nullable();
            $table->foreign('marca_cilindro_id')->references('id')->on('marcas_cilindros')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('matricula')->nullable();
            $table->string('modelo')->nullable();

            $table->string('norma_fabricacion')->nullable();
            $table->unsignedInteger('capacidad_nominal')->nullable();
            $table->unsignedInteger('diametro_nominal')->nullable();
            $table->unsignedInteger('longitud_nominal')->nullable();
            $table->float('espesor')->nullable();
            $table->string('dureza')->nullable();
            $table->string('material')->nullable();
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
        Schema::dropIfExists('datos_cilindros');
    }
}
