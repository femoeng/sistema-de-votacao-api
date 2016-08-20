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

        $visitante_valido = true;
        $arrayErro=[];

        if(isset($data['nome'])) {

        } else {
            $visitante_valido = false;
            array_push($arrayErro,"O nome é obrigatorio");
        }

        if(isset($data['tipo_documento'])){

        } else {
           $visitante_valido = false;
           array_push($arrayErro,"O tipo de documento é obrigatorio");
        }

        if (isset($data['numero_documento'])){

        } else {
          $visitante_valido = false;
          array_push($arrayErro,"O numero de documento é obrigatorio");
        }

        if(isset($data['contacto'])){

        } else {
          $visitante_valido = false;
          array_push($arrayErro, "O contacto é obrigatorio");
        }

        if(isset($data['email'])){

        }

       if(isset($data['tipo_visitante'])){

       } else {
          $visitante_valido = false;
          array_push($arrayErro,"O tipo visitante é obrigatorio");
       }

       if($visitante_valido){
            $request->{"visitante_data"} = $data;
            return $next($request);
       } else {
            return response()->json($arrayErro,400);
       }
    }
}
