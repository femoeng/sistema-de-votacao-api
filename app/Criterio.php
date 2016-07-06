<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    protected $fillable = ['nome','pesoJuri'];

       public function projectos()
    {
         return $this->belongsToMany('\App\Projecto','vota')->withPivot('visitante_id');

    }

}
