<?php

namespace App\Http\Middleware;

use Closure;

class VerificarExistenciaProjectista
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
        $projectista_id = $request->route()->parameter('projectistas');
        $projectista = \App\Projectista::findOrFail($projectista_id);
        if (isset($projectista)) {
            $request->{'projectista'} = $projectista;
            return $next($request);
        } else {
            abort(404);
        }
    }
}
