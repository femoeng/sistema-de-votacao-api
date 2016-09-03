<?php

namespace App\Http\Middleware;

use Closure;
use Slugify;
use App\Departamento;
class ValidarDepartamento
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
        $erros = [];
        $departamento_valido = true;
        $data = $request->json()->all();

        if (isset($data['nome'])) {
         if (!isset($data['id'])) {
           $data['id'] = Slugify::slugify($data['nome']);
           $dept = \App\Departamento::find($data['id']);

           if (isset($dept)) {
             $departamento_valido = $departamento_valido && false;
             array_push($erros, 'Departamento com este nome já existe');
           }
         } else {
           $dept = \App\Departamento::find($data['id']);

           if (isset($dept)) {
             $departamento_valido = $departamento_valido && false;
             array_push($erros, 'Departamento com este id já existe');
           }
         }

         if ($departamento_valido) {
           $request->{'departamento_data'} = $data;
           return $next($request);
         } else {
           return response()->json(['erros' => $erros], 400);
         }
       } else {
         $erros = ['O nome do departamento é obrigatótio'];
         return response()->json(['erros' => $erros], 400);
       }
    }
}
