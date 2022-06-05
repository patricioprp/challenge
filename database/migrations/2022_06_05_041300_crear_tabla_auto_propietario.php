<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaAutoPropietario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_propietario', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('auto_id');
            $table->unsignedBigInteger('propietario_id');
            $table->foreign('auto_id')->references('id')->on('autos')->onDelete('cascade');
            $table->foreign('propietario_id')->references('id')->on('propietarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auto_propietario');
    }
}
