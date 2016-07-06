<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected $fillable = ['nome'];

    public function visitantes()
    {
         return $this->belongsToMany('\App\Visitante','juri');

    }
}
