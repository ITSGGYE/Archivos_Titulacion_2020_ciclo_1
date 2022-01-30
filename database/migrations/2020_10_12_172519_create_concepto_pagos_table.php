<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptoPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepto_pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('concepto')->unique();
            $table->date('fechaInicial');
            $table->date('fechaFinal');
            $table->unsignedBigInteger('periodo_id');
            $table->unsignedBigInteger('curso_id');
            $table->double('valor',15,2);
            $table->double('mora',15,2);
            $table->set('estado', ['activo', 'inactivo']);
            $table->timestamps();

            $table->foreign('periodo_id')
                ->references('id')
                ->on('periodos')
                ->onCascade('delete');

            $table->foreign('curso_id')
                ->references('id')
                ->on('cursos')
                ->onCascade('delete');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concepto_pagos');
    }
}
