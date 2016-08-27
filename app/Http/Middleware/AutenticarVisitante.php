<?php

namespace App\Http\Middleware;

use Closure;

class AutenticarVisitante
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
        $contacto = $request->server('PHP_AUTH_USER');
        $pin = $request->server('PHP_AUTH_PW');

        $visitante = \App\Visitante::where('contacto', $contacto)->where('pin', $pin)->first();
        if ($visitante) {
            $request->{'visitante'} = $visitante;
            return $next($request);
          } else {
            return abort(401, 'Not authenticate', ['WWW-Authenticate' => 'Basic']);
          }
        } else {
          return abort(401, 'Not authenticate', ['WWW-Authenticate' => 'Basic']);
        }
    }
}
