<?php

namespace App\Http\Middleware;

use Closure;

class ValidarRegistoDeUtilizador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (\App\Utilizador::count() == 0) {
        $data = $request->json()->all();
        $utilizador_valido = true;
        $utilizador = [];
        $erros = [];

        if (isset($data['nome'])) {
          $utilizador['nome'] = $data['nome'];
        } else {
          $utilizador_valido = false;
          if (!isset($erros['nome'])) {
            $erros['nome'] = [];
          }

          array_push($erros['nome'], 'O nome é obrigatório');
        }

        if (isset($data['senha'])) {
          $utilizador['senha'] = \Hash::make($data['senha']);
        } else {
          $utilizador_valido = false;
          if (!isset($erros['senha'])) {
            $erros['senha'] = [];
          }

          array_push($erros['senha'], 'A senha é obrigatória');
        }

        $utilizador['privilegio'] = 'superadmin';

        if ($utilizador_valido) {
          $request->utilizador_data = $utilizador;
          return $next($request);
        } else {
          return response()->json(['erros' => $erros], 400);
        }
      } else {
        return response()->json(['erros' => ['Já existe um administrador registado']], 403);
      }
    }
}
