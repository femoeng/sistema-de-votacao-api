<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $fillable = ['nome','tipo_documento','numero_documento','contacto','email','tipo_visitante', 'pin', 'codigo'];

    public function departamentos()
    {
         return $this->belongsToMany('\App\Departamento','juri');

    }
     public function criterios()
    {
         return $this->belongsToMany('\App\Criterio','vota')->withPivot('projecto_id');
    }
}
