<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteRepresentante extends Model
{
    use HasFactory;

    protected $table = 'estudiante_representante';



    public function representante()
    {
        return $this->belongsTo('App\Models\Representante');
    }


}

