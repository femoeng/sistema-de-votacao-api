<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nome', 'slug'];

    public function departamento()
    {
    	return $this->belongsTo('\App\Departamento');
    }

}
