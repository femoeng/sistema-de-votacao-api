<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectista extends Model
{
    //
    protected $fillable=['apelido','nome','numero_celular','curso_id'];

    public function projectos()
    {
        return $this->belongsToMany('\App\Projecto','projecta')->withPivot('cetagoria_represetante');
    }
}
