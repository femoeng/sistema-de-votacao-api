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
        $projecto_valido=true;
        $arrayErro=[];
        $data=$request->json()->all();
        if(isset($data['titulo'])){

        } else{
            $projecto_valido=false;
            array_push($arrayErro, "O titulo do projecto e obrigatirio");
        }
        if(isset($data['area_aplicacao'])){

        } else{
            $projecto_valido=false; 
            array_push($arrayErro, "A area de aplicacao do projecto e obrigatirio");  
        }
        if(isset($data['descricao'])){

        } else{
            
        }
            
        if(isset($data['tutor'])){

        } else{
            
        }

        if(isset($data['cursos'])){
            $request->{"cursos"}=[];
            //return $data['cursos'];
            foreach ($data['cursos'] as $curso_id) {
                $curso= \App\Curso::where('id',$curso_id)->orWhere('slug',$curso_id)->first();
                if(isset($curso)){
                    array_push($request->cursos, $curso);

                }
            }
        }

        if($projecto_valido){
            $request->{'projecto_data'}=$data;
            return $next($request);

        }else{
            return response()->json($arrayErro, 400);
        }
    }
}
