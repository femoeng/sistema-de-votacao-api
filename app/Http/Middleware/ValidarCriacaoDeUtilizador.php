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
        $erros = [];
        $utilizador = [];
        $utilizador_valido = true;
        
        if (isset($data['nome'])) {

        } else {
          $utilizador_valido = $utilizador_valido && false;
          $erros['nome'] = [
            'O nome é obrigatório'
          ];
        }

        if (isset($data['senha'])) {

        } else {
          $utilizador_valido = $utilizador_valido && false;
          $erros['senha'] = [
            'A senha é obrigatória'
          ];
        }

        if (isset($data['privilegio'])) {

        } else {
          $utilizador_valido = $utilizador_valido && false;
          $erros['privilegio'] = [
            'O privilégio é obrigatório'
          ];
        }

        if ($utilizador_valido) {
          $utilizador['nome'] = $data['nome'];
          $utilizador['senha'] = \Hash::make($data['senha']);
          $utilizador['privilegio'] = $data['privilegio'];

          $request->utilizador_data = $utilizador;
          return $next($request);
        } else {
            return response()->json($erros, 400);
        }
    }
}
