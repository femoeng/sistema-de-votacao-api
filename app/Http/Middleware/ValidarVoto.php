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
        $data = $request->json()->all();
        $arrayErro = [];
        $visitante_valido = true;
        if(isset($data['visitante'])){
            $visitante_id = $data['visitante'];
            $visitante = \App\Visitante::find($visitante_id);
        }else{
            array_push($arrayErro, "dados do visitante nao encontrados");
            $visitante_valido=false;
        }
        if(isset($visitante)){
            foreach ($data['votos'] as $voto) {
                if( !(isset($voto['criterio']) && isset($voto['projecto']))){
                    array_push($arrayErro, "criterio ou visitante nao encontrados");
                    $visitante_valido = false;
                    break;
                }
            }
        }else{
            array_push($arrayErro, "visitante nao encontrado");
            $visitante_valido=false;
        }

        if($visitante_valido){
            $request->{"voto_data"} = $data;
            return $next($request);
        }else{
            return response()->json($arrayErro, 400);
        }

        }
}

