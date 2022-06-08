<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaVentaAuto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_auto', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('auto_id');
            $table->unsignedBigInteger('venta_id');
            $table->foreign('auto_id')->references('id')->on('autos')->onDelete('cascade');
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta_auto');
    }
}
