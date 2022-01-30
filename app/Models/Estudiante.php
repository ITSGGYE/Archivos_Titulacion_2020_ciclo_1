<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
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
        'foto',
        'estado',
        'esBecario',
        'porcentajeBeca',

    ];


    public function representantes(){
        return $this->belongsToMany(Representante::class)->withTimestamps();
    }

}
