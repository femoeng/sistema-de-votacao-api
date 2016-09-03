<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class VotoController extends Controller
{
    public function __construct(){
        $this->middleware('validar_voto',['only'=>['store']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request) {
        $votos = \App\Voto::all();
        $projectos = \App\Projecto::all();
        $criterios = \App\Criterio::all();

        $filtros = $request->input();
        $resultados = [];

        if (isset($filtros['quantidade'])) {
          $v0 = \App\Visitante::where('votou', true)->count();
          $v1 = \App\Visitante::count();
          return [
            'total_visitantes' => $v1,
            'visitantes_votantes' => $v0
          ];
        }

        foreach($projectos as $p) {
          foreach($criterios as $c) {
            $votos = \App\Voto::where('projecto_id', $p->id)->where('criterio_id', $c->id)->get();
            $voto = [
              'projecto' => $p->id,
              'criterio' => $c->id,
              'votos' => count($votos)
            ];

            array_push($resultados, $voto);
          }

        }

        return $resultados;
    }

    public function store(Request $request)
    {
        $votos = $request->voto_data;
        $visitante = $request->visitante;

        foreach($votos as $voto) {
          $voto = \App\Voto::create($voto);
        }

        $visitante->votou = true;
        $visitante->save();

        return [
            'deu' => 'tudo certo'
        ];
    }
}
