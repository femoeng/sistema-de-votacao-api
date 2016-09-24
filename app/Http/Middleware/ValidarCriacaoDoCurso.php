<?php
namespace App\Http\Middleware;

use Closure;

class ValidarCriacaoDoCurso
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

      return app(\App\Http\Middleware\VerificarExistenciaDoDepartamento::class)->handle($request, function($request) use ($next) {
        $data = $request->json()->all();
        $curso_valido = false;

        if (isset($data['nome'])) {
          $curso_valido = true;
        } else {
          $curso_valido = false;
          if (!isset($erros['nome'])) {
            $erros['nome'] = [];
          }

          array_push($erros['nome'], 'O nome do curso é obrigatório');
        }

        if ($curso_valido) {
          $request->{'curso_data'} = $data;
          return $next($request);
        } else {
          return response()->json($erros, 400);
        }
      });
    }

}
