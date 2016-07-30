<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SessaoController extends Controller
{
  public function store(Request $request) {
    $utilizador = $request->utilizador;
    $sessao = $utilizador->sessoes()->create(['id' => str_random(128)]);

    return [
      'token' => $sessao->id
    ];
  }
}
