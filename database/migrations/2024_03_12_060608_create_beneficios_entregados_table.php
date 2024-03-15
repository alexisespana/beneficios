<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiosEntregadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficios_entregados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_beneficio');
            $table->string('run');
            $table->string('dv');
            $table->string('total');
            $table->integer('estado');
            $table->date('fecha');
            $table->foreign('id_beneficio')->references('id')->on('beneficios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficios_entregados');
    }
}
