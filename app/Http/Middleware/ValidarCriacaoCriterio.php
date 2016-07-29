<?php

namespace App\Http\Middleware;

use Closure;

class ValidarCriterio
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
          if(isset($data['nome']) && isset($data['pesoJuri'])){
          return $next($request);
        }else{
            abort(400);
        }
    }
}
