<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projecto extends Model
{
    protected $fillable=['titulo','area_aplicacao','descricao','imagem','tutor' ];

     public function cursos()
    {
       return $this->belongsToMany('\App\Curso','provem');
    }
    public function projectistas()
    {
        return $this->belongsToMany('\App\Projecto','projecta');
    }
       
}
s