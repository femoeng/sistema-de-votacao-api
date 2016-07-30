<?php

namespace App\Http\Middleware;

use Closure;

class VerificarToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $privilegio)
    {
      $cabecalho = $request->server('HTTP_AUTHORIZATION');

      if (isset($cabecalho) && preg_match('/Token\s+(.*)$/i', $cabecalho, $matches)) {
        $token = $matches[1];

        $sessao = \App\Sessao::find($token);

        if ($sessao) {
          $utilizador = $sessao->utilizador;
          if ($utilizador->privilegio == $privilegio) {
            $request->{'utilizador'} = $utilizador;
            return $next($request);
          } else {
            abort(403);
          }
        } else {
          return abort(401, 'Not authenticate', ['WWW-Authenticate' => 'Basic']);
        }
      } else {
        return abort(401, 'Not authenticate', ['WWW-Authenticate' => 'Basic']);
      }
    }
}
