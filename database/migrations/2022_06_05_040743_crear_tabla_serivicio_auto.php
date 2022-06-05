<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaSerivicioAuto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_auto', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('auto_id');
            $table->unsignedBigInteger('servicio_id');
            $table->foreign('auto_id')->references('id')->on('autos')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio_auto');
    }
}
