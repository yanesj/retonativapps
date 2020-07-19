<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
     public function cursos(){
        return $this->belongsToMany('App\Curso');
    }
}
