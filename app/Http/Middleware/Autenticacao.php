<?php

namespace App\Http\Middleware;

use Closure;

class Autenticacao
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

      if (isset($cabecalho) && preg_match('/Basic\s+(.*)$/i', $cabecalho, $matches)) {
        $nome = $request->server('PHP_AUTH_USER');
        $senha = $request->server('PHP_AUTH_PW');

        $utilizador = \App\Utilizador::where('nome', $nome)->first();
        if ($utilizador) {
          if (\Hash::check($senha, $utilizador->senha)) {
            $request->{'utilizador'} = $utilizador;
            return $next($request);
          } else {
            return abort(401, 'Not authenticate', ['WWW-Authenticate' => 'Basic']);
          }
        } else {
          return abort(401, 'Not authenticate', ['WWW-Authenticate' => 'Basic']);
        }
      } else {
        return abort(401, 'Not authenticate', ['WWW-Authenticate' => 'Basic']);
      }
    }
}
