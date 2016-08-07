<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectista extends Model
{
    //
    protected $fillable=['numero_estudante','apelido','nome','numero_celular'];

<<<<<<< HEAD
   
=======
    public function projectos()
    {
        return $this->belongsToMany('\App\Projecto','projecta')->withPivot('cetagoria_represetante');
    }

    public function curso(){
    	return $this->belongsTo('\App\Curso');
    }
>>>>>>> fc914e361c3b4abed2b601bc418698e041381ab8
}
