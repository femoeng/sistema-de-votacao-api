<?php

namespace App\Http\Middleware;

use Closure;

class ValidarCriacaoDeUtilizador
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

        if (isset($data['nome'])) {
          $utilizador['nome'] = $data['nome'];
        } else {
          $utilizador_valido = false;
        }

        if (isset($data['senha'])) {
          $utilizador['senha'] = \Hash::make($data['senha']);
        } else {
          $utilizador_valido = false;
        }

        if (isset($data['privilegio'])) {
          $utilizador['privilegio'] = $data['privilegio'];
        } else {
          $utilizador_valido = false;
        }

        if ($utilizador_valido) {
          $request->utilizador_data = $utilizador;
          return $next($request);
        } else {
          abort(400);
        }
      } else {
        abort(403);
      }
    }
}
