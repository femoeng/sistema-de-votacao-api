<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SessaoController extends Controller
{
  public function store(Request $request) {
    $utilizador = $request->utilizador;
    $sessao = $utilizador->sessoes()->create(['id' => sha1(str_random(128))]);

    return [
      'token' => $sessao->id
    ];
  }

  public function destroy(Request $request, $id) {
    $utilizador = $request->utilizador;
    $sessao = $utilizador->sessoes()->find($id);
    if ($sessao) {
      $sessao->delete();

      abort(204);
    } else {
      abort(404);
    }
  }
}
