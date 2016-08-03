<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilizador extends Model
{
    protected $table = 'utilizadores';
    protected $fillable = ['nome', 'senha', 'privilegio'];

    public function sessoes() {
      return $this->hasMany(\App\Sessao::class, 'utilizador_id', 'id');
    }
}
