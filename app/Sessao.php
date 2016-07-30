<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Utilizador;

class Sessao extends Model
{
  protected $table = 'sessoes';
  protected $fillable = ['id'];
  public $incrementing = false;

  public function utilizador() {
    return $this->belongsTo(\App\Utilizador::class, 'utilizador_id', 'id');
  }
}
