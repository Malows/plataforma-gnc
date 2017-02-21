<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('from_id');
            $table->foreign('from_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('to_id');
            $table->foreign('to_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('asunto')->nullable();
            $table->text('mensaje')->nullable();
            $table->timestamp('leido')->nullable()->default(null);
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
        Schema::dropIfExists('mensajes');
    }
}
