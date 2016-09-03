<?php

namespace App\Http\Middleware;

use Closure;

class ValidarCurso
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
        $data = $request->json()->all();
        $curso_valido = true;
        $erros = [];

        if (isset($data['nome'])) {
        } else {
          $erros['nome'] = [];
          $curso_valido = $curso_valido && false;
          array_push($erros['nome'], 'O nome é obrigatório');
        }

        if ($curso_valido) {
          return $next($request);
        } else {
          return response()->json($erros, 400);
        }
    }
}
