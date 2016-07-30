<?php

namespace App\Http\Middleware;

use Closure;

class VerificarVisitante
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
         $visitante_id = $request->route()->parameter('visitantes');
         $visitante = \App\Visitante::findOrFail($visitante_id);
         if (isset($visitante)) {
             $request->{'visitante'} = $visitante;
             return $next($request);
         } else {
             abort(404);
         }
     }
}
