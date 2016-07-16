<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DepartamentoController extends Controller
{

    public function __construct(){
        $this->middleware('validar_departamento', ['only'=>['store']]);
        $this->middleware('validar_edicao_do_departamento', ['only' => ['update']]);
        $this->middleware('verificar_existencia_do_departamento', ['only' => ['destroy', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departamentos = \App\Departamento::all();
        if (count($departamentos) > 0) {
          return [
            'departamentos' => $departamentos
          ];
        } else {
          abort(404);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departamentos_data = $request->departamento_data;
        $departamento = \App\Departamento::create($departamentos_data);
        return $departamento;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $departamento = $request->departamento;
        return $departamento;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $departamento = $request->departamento;
        $data = $request->departamento_data;
        $departamento->fill($data);
        $departamento->save();

        return $departamento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $departamento = $request->departamento;
      $departamento->delete();
    }
}
