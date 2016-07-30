<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Utilizador;

class UtilizadorController extends Controller
{
  private $request;
  public function __construct() {
    $this->middleware('validar_registo_do_primeiro_utilizador', ['only' => ['registo']]);
    $this->middleware('validar_criacao_utilizador', ['only'=>['store']]);
    $this->middleware('validar_edicao_do_utilizador', ['only' => ['update']]);
    $this->middleware('verificar_existencia_do_utilizador', ['only' => ['destroy', 'show']]);
}

  public function registo(Request $request) {
    $data = $request->utilizador_data;
    $utilizador = \App\Utilizador::create($data);
    return $utilizador;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilizadores= \App\Utilizador::all();
        return $utilizadores;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->utilizador_data;
        $utilizador = \App\Utilizador::create($data);
        return $utilizador;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Utilizador= \App\Utilizador::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Utilizador= \App\Utilizador::findOrFail($id);
        $Utilizador= $request->json();
        $Utilizador->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Utilizador::destroy($id);
    }



}
