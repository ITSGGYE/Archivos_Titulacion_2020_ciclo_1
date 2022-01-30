<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cedula')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo');
            $table->string('telefono');
            $table->text('direccion');
            $table->date('fechaNacimiento');
            $table->set('genero', ['masculino', 'femenino']);
            $table->set('esRepresentanteLegal',['si', 'no']);
            $table->set('tipoRepresentante', ['padre', 'madre','hermano','hermana','tío','tía','abuelo','abuela']);
            $table->set('estado', ['activo', 'inactivo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representante');
    }
}
