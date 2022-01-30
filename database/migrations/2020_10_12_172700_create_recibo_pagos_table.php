<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReciboPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo_pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('conceptoPago_id');
            $table->unsignedBigInteger('estudiante_id');
            $table->double('valorPagado',15,2);
            $table->set('estado', ['pendiente', 'pagado']);
            $table->timestamps();


            $table->foreign('conceptoPago_id')
                ->references('id')
                ->on('concepto_pagos')
                ->onCascade('delete');

            $table->foreign('estudiante_id')
                ->references('id')
                ->on('estudiantes')
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
        Schema::dropIfExists('recibo_pagos');
    }
}
