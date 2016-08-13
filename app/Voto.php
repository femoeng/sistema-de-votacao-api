<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
   protected $table = "vota";

    public function visitantes(){
//belongsTo
 return $this->belongsTo('\App\Visitante','vota')->withPivot('visitante_id');

    }
     public function criterios(){
 return $this->belongsTo('\App\criterio','vota')->withPivot('criterio_id');

    }
     public function projectos(){

 return $this->belongsTo('\App\Projecto','vota')->withPivot('projecto_id');

    }
}
