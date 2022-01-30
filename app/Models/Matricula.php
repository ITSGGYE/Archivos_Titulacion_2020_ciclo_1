<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_id',
        'periodo_id',
        'estudiante_id',
        'matriculado',
        'estado',

    ];


    public function curso()
    {
        return $this->belongsTo('App\Models\Curso');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Models\Periodo');
    }


    public function estudiante()
    {
        return $this->belongsTo('App\Models\Estudiante');
    }




}
