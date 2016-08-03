<?php

namespace App\Http\Middleware;

use Closure;

class VerificarExistenciaDoDepartamento
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
      $utilizador_id = $request->route()->parameter('utilizadores');
      $utilizador = \App\Departamento::findOrFail($utilizador_id);
      if (isset($utilizador)) {
          $request->{'utilizador'} = $utilizador;
          return $next($request);
      } else {
        abort(404);
      }
    }
}
