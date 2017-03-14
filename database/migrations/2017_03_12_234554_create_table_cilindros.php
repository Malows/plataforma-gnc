<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCilindros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cilindros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_de_cilindro');
            $table->unsignedInteger('datos_cilindro_id');
            $table->foreign('datos_cilindro_id')->references('id')->on('datos_cilindros')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('marca_cilindro_id');
            $table->foreign('marca_cilindro_id')->references('id')->on('marcas_cilindros')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('tipo_cilindro',['GNC vehicular', 'GNC estacional', 'Gas Industrial', 'Matafuegos'])->default('GNC vehicular');
            $table->float('volumen');

            $table->unsignedInteger('vehiculo_id');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamp('fecha_de_fabricacion')->nullable();
            $table->timestamp('ultima_prueba_hidraulica')->nullable();
            $table->string('resultado_de_prueba_hidraulica')->nullable();
            $table->timestamp('fecha_de_vencimiento');

            $table->unsignedInteger('user_id')->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set default')->onUpdate('cascade');

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
        Schema::dropIfExists('cilindros');
    }
}
