<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudianteRepresentanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiante_representante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('representante_id');
            $table->timestamps();

            $table->foreign('estudiante_id')
                ->references('id')
                ->on('estudiantes')
               ->onCascade('delete');

            $table->foreign('representante_id')
                ->references('id')
                ->on('representantes')
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
        Schema::dropIfExists('estudiante_representante');
    }
}
