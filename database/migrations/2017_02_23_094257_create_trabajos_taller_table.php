<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajosTallerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos_de_talleres', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('servicio_de_taller_id');
            $table->foreign('servicio_de_taller_id')
                ->references('id')->on('servicios_de_talleres')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('vehiculo_id');
            $table->foreign('vehiculo_id')
                ->references('id')->on('vehiculos')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('estado',['No ingresado','Por revisar', 'En proceso', 'Finalizado', 'Retirado'])
                ->default('No ingresado');

            $table->timestamp('fecha_de_turno')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamp('por_revisar_at')->nullable();
            $table->timestamp('en_proceso_at')->nullable();
            $table->timestamp('finalizado_at')->nullable();
            $table->timestamp('retirado_at')->nullable();

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
        Schema::dropIfExists('trabajos_talleres');
    }
}
