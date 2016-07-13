<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected $fillable = ['nome'];

    public function cursos()
    {
    	return $this->hasMany('\App\Cruso');
    }
}
