<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cedula')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo');
            $table->string('telefono');
            $table->text('direccion');
            $table->string('foto')->nullable();
            $table->date('fechaNacimiento');
            $table->set('genero', ['masculino', 'femenino']);
            $table->set('esBecario', ['si', 'no']);
            $table->integer('porcentajeBeca' )->nullable();
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
        Schema::dropIfExists('estudiante');
    }
}
