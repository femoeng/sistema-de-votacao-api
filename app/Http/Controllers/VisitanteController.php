<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class VisitanteController extends Controller
{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('validar_criacao_do_visitante', ['only' => ['store']]);
        $this->middleware('validar_edicao_do_visitante', ['only' => ['update']]);
        $this->middleware('verificar_existencia_do_visitante', ['only' => ['show', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
{
  $visitantes = \App\Visitante::all();
  if (count($visitantes) > 0) {
    return  [
        'visitantes' => $visitantes
    ];

  } else {
    return response()->json(['erros' => ['Não existem visitantes registados']], 404);
  }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $visitantes_data=$request->json()->all();
        $Visitante = \App\Visitante::create($visitantes_data);
        return $Visitante;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Visitante = \App\Visitante::findOrFail($id);
        return $Visitante;
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
        $data = $request->visitante_data;
        $visitante = $request->visitante;
        $visitante->fill($data);
        $visitante->save();
        return response(['mensagem' => ['Actualização realizada com sucesso']], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Visitante::destroy($id);
    }
}
