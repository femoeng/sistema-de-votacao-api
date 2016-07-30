<?php

namespace App\Http\Middleware;

use Closure;

class ValidarRegistoDeUtilizador
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
        if (isset($data['nome']) && isset($data['senha']) && isset($data['privilegio'])) {
          $utilizador['nome'] = $data['nome'];
          $utilizador['senha'] = \Hash::make($data['senha']);
          $utilizador['privilegio'] = $data['privilegio'];
          $request->utilizador_data = $utilizador;
          return $next($request);
        } else {
          abort(400);
        }

    }
}
