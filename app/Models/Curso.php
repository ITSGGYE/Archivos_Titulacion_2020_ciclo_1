<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;


    protected $fillable = [
        'grado_id',
        'paralelo_id',
        'estado',

    ];


    public function grado()
    {
        return $this->belongsTo('App\Models\Grado');
    }


    public function paralelo()
    {
        return $this->belongsTo('App\Models\Paralelo');
    }


}
