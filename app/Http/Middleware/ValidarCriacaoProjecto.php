<?php

namespace App\Http\Middleware;

use Closure;

class ValidarCriacaoProjecto
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
        $data=$request->json()->all();
        if(isset($data['titulo']) && isset($data['areaAplic']) && isset($data['descr']) && isset($data['imagem']) && isset($data['tutor'])){
            return $next($request);
        }else{
            abort(400);
        }
    }
}
