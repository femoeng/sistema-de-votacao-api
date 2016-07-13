<?php

namespace App\Http\Middleware;

use Closure;

class ValidarProjectista
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
         if(isset($data['nome']) && isset($data['apelido']) && isset($data['numero_celular']) && isset($data['curso_id'])){
            return $next($request);
        }else{
            abort(400);
       }
    }
}
