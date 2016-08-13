<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectista extends Model
{
    //
    protected $fillable=['numero_estudante','apelido','nome','numero_celular'];


    public function projectos()
    {
        return $this->belongsToMany('\App\Projecto','projecta')->withPivot('cetagoria_represetante');
    }

    public function curso(){
    	return $this->belongsTo('\App\Curso');
    }

}
