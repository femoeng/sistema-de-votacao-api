<?php

namespace App\Http\Middleware;

use Closure;

class ValidarCriacaoVisitante
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
        if(isset($data['nome']) && isset($data['tipoDoc']) && isset($data['numero_Documento']) && isset($data['contacto']) && isset($data['email']) && isset($data['tipo_visitante'])){
           $request->{'visitante_data'} = $data;
            return $next($request);
        }else{
            abort(400);
        }
    }
}
