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
      $id = $request->route()->parameter('departamentos');
      $departamento = \App\Departamento::find($id);

      if (isset($departamento)) {
          $request->{'departamento'} = $departamento;
          return $next($request);
      } else {
        $erros = [
          'erros' => [
              'Departamento não encontrado'
          ]
        ];
        
        return response($erros, 404);
      }
    }
}
