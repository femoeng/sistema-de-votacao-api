<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projecto extends Model
{
    protected $fillable=['tituloPro','areaAplic','','descr','imagem','tutor'];

     public function cursos()
    {
       return $this->belongsToMany('\App\Curso','provem');
    }
    public function projectistas()
    {
        return $this->belongsToMany('\App\Projecto','projecta')->withPivot('cetagoria_represetante');
    }
       public function criterios()
    {
         return $this->belongsToMany('\App\Criterio','vota')->withPivot('visitante_id');

    }
}
