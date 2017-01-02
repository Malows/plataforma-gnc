<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcasAutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcas_autos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');

            $table->integer('id_usuario')->unsigned()->default(1)
            ->comment("Quien agregó la marca de autos. Si fletamos usuarios, nos quedamos con sus datos, bien gracias");
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
        Schema::dropIfExists('marcas_autos');
    }
}
