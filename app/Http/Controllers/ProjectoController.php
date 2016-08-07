<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProjectoController extends Controller
{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('validar_criacao_do_projecto', ['only' => ['store']]);
        $this->middleware('verificar_existencia_do_projecto', ['only' => ['show', 'destroy']]);
        $this->middleware('validar_edicao_do_projecto', ['only' => ['update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectos= \App\Projecto::all();
        return $projectos;
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
        $projecto_data=$request->json()->all();
        $Projecto= \App\Projecto::create($projecto_data);
        return $Projecto;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Projecto= \App\Projecto::findOrFail($id);
        return $Projecto;
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
        $Projecto= \App\Projecto::findOrFail($id);
        $Projecto= $request->json();
        $Projecto->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Projecto::destroy($id); 
    }

}
