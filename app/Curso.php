<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable=['nombre','fecha_inicio','fecha_fin'];

    public function estudiantes(){
        return $this->belongsToMany('App\Estudiante');
    }

    public function horarios(){
        return $this->belongsToMany('App\Horario');
    }
}    

