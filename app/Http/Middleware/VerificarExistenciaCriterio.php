<?php

namespace App\Http\Middleware;

use Closure;

class VerificarExistenciaCriterio
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
        $criterio_id = $request->route()->parameter('criterios');
        $criterio = \App\Criterio::findOrFail($criterio_id);
        if (isset($criterio)) {
            $request->{'criterio'} = $criterio;
            return $next($request);
        } else {
            abort(404);
        }
    }
}
