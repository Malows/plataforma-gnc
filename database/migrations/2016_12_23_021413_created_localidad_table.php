<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedLocalidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localidades', function( Blueprint $table ) {
          $table->increments('id');
          $table->string('nombre');
          $table->integer('codigo_postal');
          $table->integer('id_provincia')->unsigned();
          $table->timestamps();

          $table->foreign('id_provincia')
            ->references('id')->on('provincias')
            ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localidades');
    }
}
