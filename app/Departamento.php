<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected $fillable = ['id', 'nome'];
    public $incrementing = false;

    public function cursos()
    {
    	return $this->hasMany('\App\Curso');
    }
}
