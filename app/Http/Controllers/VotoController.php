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
        $oout = [];
        $pp = [];
        $ppp = [];


        if (isset($filtros['quantidade'])) {
          $v0 = \App\Visitante::where('votou', true)->count();
          $v1 = \App\Visitante::count();
          return [
            'total_visitantes' => $v1,
            'visitantes_votantes' => $v0
          ];
        }

        foreach($criterios as $c) {
          $resultados[$c->id] = [];
          foreach($projectos as $p) {
            $votos = \App\Voto::where('projecto_id', $p->id)->where('criterio_id', $c->id)->get();
            $voto = [
              'projecto' => \App\Projecto::find($p->id),
              'quantidade' => count($votos)
            ];

            array_push($resultados[$c->id], $voto);
          }
        }

        $saida = [];
        foreach($resultados as $k => $v) {
          usort($v, function ($a,$b) {
            return $a['quantidade'] <= $b['quantidade'];
          });

          $s = [
            'criterio' => \App\Criterio::find($k),
            'votos' => $v
          ];

          array_push($saida, $s);
        }

        foreach($projectos as $p) {
          $pp[$p->id] = [];
          foreach ($criterios as $c) {
            $votos = \App\Voto::where('projecto_id', $p->id)->where('criterio_id', $c->id)->count();
            array_push($pp[$p->id], $votos);
          }
        }

        foreach ($pp as $k => $v) {
          $soma = array_sum($v);
          $total = count($v);
          $media = $soma/$total;

          $quadrados = array_map(function($n) {
            return $n*$n;
          }, $v);

          $diferencas = array_map(function($n) use ($media){
            return $n - $media;
          }, $v);

          $soma_dos_quadrados = array_sum($quadrados);
          $somatorio_ao_quadrado = $soma * $soma;

          $desvio = sqrt(($soma_dos_quadrados - (1/$total)*$somatorio_ao_quadrado));

          $ppp[$k] = [
            'media'  => $media,
            'somatorio'   => $soma,
            'desvio' => $desvio
          ];
        }

        uasort($ppp, function($a, $b) {
          if ($a['somatorio'] < $b['somatorio']) {
            return 1;
          } else if ($a['somatorio'] == $b['somatorio']) {
            if ($a['desvio'] <= $b['desvio']) {
              return -1;
            } else {
              return 1;
            }
          } else {
            return -1;
          }
        });

        foreach($ppp as $kk => $vv) {
          $out = [
            'projecto' => \App\Projecto::find($kk),
            'total_de_votos' => $vv['somatorio'],
            'media_de_votos_por_criterio' => $vv['media'],
            'desvio_padrao_de_votos_por_criterio' => $vv['desvio']
          ];
          array_push($oout, $out);
        }

        if (isset($filtros['criterio'])) {
          return $saida;
        }

        // foreach ($oout as $k => $v) {
        //   $oout[$k]['posicao'] = $k + 1;
        // }
        return $oout;
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

        return response()->json(['mensagem' => ['Voto realizado com sucesso']], 201);
    }
}
