<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $fillable = ['nome','tipoDoc','numero_Documento','contacto','email','tipo_visitante'];

    public function departamentos()
    {
         return $this->belongsToMany('\App\Departamento','juri');

    }
     public function criterios()
    {
         return $this->belongsToMany('\App\Criterio','vota')->withPivot('projecto_id');

    }

}


