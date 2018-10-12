<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EvaluacionesEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones_empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_empleado');
            $table->unsignedInteger('id_indicador');
            $table->unsignedInteger('id_user');
            $table->float('valor');
            $table->timestamps();

            $table->foreign('id_empleado')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('id_indicador')->references('id')->on('indicadores')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluaciones_empleados');
    }
}
