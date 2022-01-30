<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('grado_id');
            $table->unsignedBigInteger('paralelo_id');
            $table->set('estado', ['activo', 'inactivo']);
            $table->timestamps();

            $table->foreign('grado_id')
                ->references('id')
                ->on('grados')
                ->onCascade('delete');

            $table->foreign('paralelo_id')
                ->references('id')
                ->on('paralelos')
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
        Schema::dropIfExists('curso');
    }
}
