<?php

namespace App\Http\Middleware;

use Closure;

class ValidarVoto
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
        $data= $request->json()->all();
        if(isset($data['visitante']) && isset($data['criterio_id']) 
        && isset($data['projecto_id'])) {
        $request->{'voto_data'} = $data;
            return $next($request);
        }else{
            abort(400);
        }
    }
}
