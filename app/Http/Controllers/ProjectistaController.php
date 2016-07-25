<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProjectistaController extends Controller
{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('validar_criacao_do_projectista', ['only' => ['store']]);
        $this->middleware('verificar_existencia_do_projectista', ['only' => ['show', 'destroy']]);
        $this->middleware('validar_edicao_do_projectista', ['only' => ['update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $projectistas= \App\Projectista::all();
        return $projectistas;
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
    public function store(Request $request,$id)
    {
        $projectista_data=$request->json()->all();
        $Departamento = \App\Departamento::create($projectista_data);
        return $Departamento;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Projectista = \App\Projectista::findOrFail($id);
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
        $projectista= \App\Projectista::findOrFail($id);
        $projectista= $request->json();
        $projectista->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Projectista::destroy($id);
    }
}
