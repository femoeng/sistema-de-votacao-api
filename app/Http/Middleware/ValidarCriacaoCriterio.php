<?php

namespace App\Http\Middleware;

use Closure;

class ValidarCriacaoCriterio
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
       $erros = [];
        if(isset($data['nome'])){
          return $next($request);
        } else {
          array_push($erros, 'Nome do critério não definido');
          return response()->json($erros, 400);
        }
    }
}
