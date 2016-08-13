<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
   protected $table = "vota";

    public function visitante(){
//belongsTo
 return $this->belongsTo('\App\Visitante','vota');

    }
     public function criterios(){
return $this->belongsTo('\App\criterio','vota');

    }
     public function projectos(){

 return $this->belongsTo('\App\Projecto','vota');

    }
}
