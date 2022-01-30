<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    use HasFactory;


    protected $fillable = [
        'cedula',
        'nombre',
        'apellido',
        'correo',
        'telefono',
        'direccion',
        'fechaNacimiento',
        'genero',
        'esRepresentanteLegal',
        'tipoRepresentante',
        'estado',

    ];



    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class)->withTimestamps();
    }
}
