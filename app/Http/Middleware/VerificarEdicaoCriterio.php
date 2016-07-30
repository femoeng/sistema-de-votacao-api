<?php

namespace App\Http\Middleware;

use Closure;

class VerificarEdicaoCriterio
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
            if (isset($data['id'])) {
                $request->{'criterio_data'} = $data;
                return $next($request);
            } else {
                abort(400);
            }

    }
}
