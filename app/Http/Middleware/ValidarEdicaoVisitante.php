<?php

namespace App\Http\Middleware;

use Closure;

class ValidarEdicaoVisitante
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
        return app(App\Http\Middleware\VerificarExistenciaVisitante::class)->handle($request, function($request) use ($next){
            $data = $request->json()->all();
            $id = $request->route()->parameter('visitantes');
            $visitante = \App\Visitante::find($id);
            if(isset($visitante)) {
             
                 if(isset($data['nome'])){


                 }
                if(isset($data['tipo_documento'])){

                 }

                 if(isset($data['numero_documento'])){

                 }
                 if(isset($data['contacto'])){

                 }
                 if(isset($data['email'])){

                 }
                 if(isset($data['tipo_visitante'])){

                 }
                $request->{'visitante_data'} = $data; 
                return $next($request);

            
            } else {
                abort(400);
            }
        });

    }
}

 
