<?php

namespace App\Http\Middleware;

use Closure;

class ValidarConteudoDaMensagem
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
        if ((strlen($request["from"]) > 0) AND (strlen($request["message"]) > 0) AND
            (strlen($request["sent_timestamp"]) > 0 )) {
            return $next($request);
        }else{
            abort(404);
        }
    }
}
