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
          $table->unsignedInteger('tipo_usuario_id')->default(6)->after('password');
          $table->foreign('tipo_usuario_id')
            ->references('id')->on('tipos_usuarios')
            ->onDelete('cascade')->onUpdate('cascade');

          $table->boolean('habilitado')->default(true);
          $table->timestamp('asistencia_inmediata')->nullable();
          $table->timestamp('fecha_de_licencia')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->unsignedBigInteger('duracion_de_licencia');

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
