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
      $departamento_id = $request->route()->parameter('departamentos');
      $departamento = \App\Departamento::find($departamento_id);

      if (isset($departamento)) {
          $request->{'departamento'} = $departamento;
          return $next($request);
      } else {
        abort(404);
      }
    }
}
