<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $fillable = ['nome','tipoDoc','numero_Documento','contacto','email','tipo_visitante'];
}
