<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CursoController extends Controller
{
    private $request;
     public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('verificar_existencia_do_departamento', ['only' => ['index', 'store']]);
        $this->middleware('validar_criacao_do_curso', ['only' => ['store']]);
        $this->middleware('verificar_existencia_do_curso', ['only' => ['show', 'destroy']]);
        $this->middleware('validar_edicao_do_curso', ['only' => ['update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $departamento = $this->request->departamento;
      $cursos = $departamento->cursos()->get();
      if (count($cursos) > 0) {
        $curso_obj = [
          'cursos' => $cursos
        ];

        return $curso_obj;
      } else {
        abort(404);
      }
    }

    /**
     * Store a newly created resource in storage and store at the associated table.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $departamento = $this->request->departamento;
        $cursos_data = $this->request->curso_data;
        $curso = $departamento->cursos()->create($cursos_data);
        return $curso;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      return $this->request->curso;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
      $data = $this->request->curso_data;
      $curso = $this->request->curso;
      $curso->fill($data);
      $curso->save();

      return $curso;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $curso = $this->request->curso;
      $curso->delete();
      abort(204);
    }
}
