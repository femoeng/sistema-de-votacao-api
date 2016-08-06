<?php

namespace App\Http\Middleware;

use Closure;

class ValidarCriacaoProjectista
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
        $projectista_valido=true;
        $arrayErro=[];
        if(isset($data["nome"])){
            
        }else{
            $projectista_valido=false;
            array_push($arrayErro, "O nome e obrigatorio");
        }
        if(isset($data["apelido"])){

        }else{
            $projectista_valido=false;
            array_push($arrayErro, "O apelido e obrigatorio");
        }
        if(isset($data["numero_celular"])){

        }else{
            $projectista_valido=false;
            array_push($arrayErro, "O numero_celular e obrigatorio");
        }
        if(isset($data["numero_estudante"])){

        }else{
            
            
        }
        if(isset($data["curso"])){
            $curso=\App\Curso::where('id', $data['curso'])->orWhere('slug',$data['curso'])->first();
            if(isset($curso)){
                $request->{"curso"}=$curso;
            }else{
                $projectista_valido=false;
                array_push($arrayErro, "O curso nao existe");
            }
        }


        if($projectista_valido){
            $request->{"projectista_data"}=$data;
            return $next($request);
        }else{
            return response()->json($arrayErro, 400);
        }



    }
}
