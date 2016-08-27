<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class VisitanteSessaoController extends Controller
{
  public function __construct() {
    $this->middleware('verificar_credenciais_do_visitante', ['only' => ['store']]);
  }
  public function store(Request $request) {
    $visitante = $request->visitante;
    return $visitante;
  }
}
