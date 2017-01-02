<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteUsersTableAddTipoUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->integer('tipo_usuario')->unsigned()->default(6)->after('password');
          $table->boolean('habilitado')->default(true)->after('tipo_usuario');
          $table->timestamp('fecha_de_licencia')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->bigInteger('duracion_de_licencia')->unsigned();
          $table->foreign('tipo_usuario')
            ->references('id')->on('tipos_usuarios')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
