<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nome'];

    public function projectos()
    {
       return $this->belongsToMany('\App\Projecto','provem');
    }

}
