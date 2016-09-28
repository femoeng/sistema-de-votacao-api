<?php

namespace App\Http\Middleware;

use Closure;

class ValidarMensagem
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
        if(isset($data['from']) && isset($data['sent_to']) && isset($data['message']) &&
            isset($data['sent_timestamp']) ){
            return $next($request);
        }else{
            abort(400);
        }
    }
}
