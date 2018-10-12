<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AreasIndicadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas_indicadores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_indicador');
            $table->unsignedInteger('id_area');

            $table->foreign('id_area')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('id_indicador')->references('id')->on('indicadores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas_indicadores');
    }
}
