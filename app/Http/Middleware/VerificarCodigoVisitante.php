<?php

namespace App\Http\Middleware;

use Closure;

class VerificarCodigoVisitante
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
      $cabecalho = $request->server('HTTP_AUTHORIZATION');

      if (isset($cabecalho) && preg_match('/Token\s+(.*)$/i', $cabecalho, $matches)) {
        $token = $matches[1];

        $visitante = \App\Visitante::where('codigo', $token)->first();

        if ($visitante) {
          if (!$visitante->votou) {
            $request->{'visitante'} = $visitante;

            return $next($request);
          } else {
            return response()->json(['erros' => ['o visitante já votou']], 403);
          }
        } else {
          return response()->json(['erros' => ['credenciais inválidos']], 401);
        }
      } else {
        return response()->json(['erros' => ['código de visitante não passado']], 401);
      }
    }
}
