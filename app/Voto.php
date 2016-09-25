<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    protected $table = "vota";
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['visitante_id', 'criterio_id', 'projecto_id'];

    public function visitante() {
      return $this->belongsTo('\App\Visitante','vota');
    }

    public function criterios(){
      return $this->belongsTo('\App\criterio','vota');
    }

    public function projectos(){
      return $this->belongsTo('\App\Projecto','vota');
    }
}
