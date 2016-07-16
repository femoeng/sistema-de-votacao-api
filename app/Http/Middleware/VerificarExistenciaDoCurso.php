<?php

namespace App\Http\Middleware;

use Closure;

class VerificarExistenciaDoCurso
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
      return app(VerificarExistenciaDoDepartamento::class)->handle($request, function($request) use ($next) {
        $curso_id = $request->route()->parameter('cursos');

        $curso = \App\Curso::where('id', $curso_id)->OrWhere('slug', $curso_id)->first();
        if (isset($curso)) {
          $request->{'curso'} = $curso;
          return $next($request);
        } else {
          abort(404);
        }
      });
    }
}
