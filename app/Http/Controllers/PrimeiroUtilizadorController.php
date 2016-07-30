<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Utilizador;

class PrimeiroUtilizadorController extends Controller
{
  public function __construct() {
    $this->middleware('validar_registo_do_primeiro_utilizador', ['only' => ['registo']]);
  }

  public function registo(Request $request) {
    $data = $request->utilizador_data;
    $utilizador = \App\Utilizador::create($data);
    return $utilizador;
  }
}
