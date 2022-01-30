<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('periodo_id');
            $table->unsignedBigInteger('curso_id');
            $table->unsignedBigInteger('estudiante_id');
            $table->set('matriculado', ['si', 'no']);
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
        Schema::dropIfExists('matriculas');
    }
}
