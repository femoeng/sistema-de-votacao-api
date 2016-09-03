<?php

namespace App\Http\Middleware;

use Closure;
use App\Projecto;
use App\Http\Middleware\VerificarCodigoVisitante;

class ValidarVoto
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
      return app(\App\Http\Middleware\VerificarCodigoVisitante::class)->handle($request, function($request) use ($next) {
        $data = $request->json()->all();
        $erros = [];

        $votos_validos = true;
        $visitante_valido = false;
        $projecto_existente = false;
        $criterio_existente = false;
        $votos = [];

        $repeticoes = [
        ];
        $cs = \App\Criterio::all();

        foreach($cs as $c) {
            $repeticoes[$c->id] = 0;
        }

        $visitante = $request->visitante;

        if (isset($data['votos']) && is_array($data['votos']) && count($data['votos']) > 0) {
          foreach($data['votos'] as $i => $v) {
            $projecto = null;
            $criterio = null;


            $erro_voto = [
              'voto' => $i + 1,
            ];

            if (isset($v['projecto'])) {
              $projecto = \App\Projecto::find($v['projecto']);
              if (isset($projecto)) {
                $projecto_existente = true;
              } else {
                if (!isset($erro_voto['projecto'])) {
                  $erro_voto['projecto'] = [];
                }

                array_push($erro_voto['projecto'], 'projecto não encontrado');
              }
            } else {
              if (!isset($erro_voto['projecto'])) {
                $erro_voto['projecto'] = [];
              }

              array_push($erro_voto['projecto'], 'projecto não definido');
            }

            if (isset($v['criterio'])) {
              $criterio = \App\Criterio::find($v['criterio']);
              if (isset($criterio)) {
                $criterio_existente = true;

                $repeticoes[$v['criterio']] = $repeticoes[$v['criterio']] + 1;
              } else {
                if (!isset($erro_voto['citerio'])) {
                  $erro_voto['criterio'] = [];
                }
                array_push($erro_voto['criterio'], 'critério não encontrado');
              }
            } else {
              if (!isset($erro_voto['citerio'])) {
                $erro_voto['criterio'] = [];
              }

              array_push($erro_voto['criterio'], 'critério não definido');
            }

            $voto_valido = $criterio_existente && $projecto_existente;
            $votos_validos = $votos_validos && $voto_valido;

            if ($voto_valido) {
              $voto = [
                'visitante_id' => $visitante->id,
                'criterio_id'  => $v['criterio'],
                'projecto_id'  => $v['projecto'],
              ];

              foreach($repeticoes as $k => $v) {
                if ($v > 1) {
                  $votos_validos = false;
                  array_push($erros, 'Não podem haver critérios repetidos');
                  break;
                }
              }

              array_push($votos, $voto);
            } else {
              array_push($erros, $erro_voto);
            }
          }
        } else {
          $erros = ['votos não foram passados'];
          $votos_validos = false;
        }

        if ($votos_validos) {
          $request->{'voto_data'} = $votos;
          return $next($request);
        } else {
          return response()->json(['erros' => $erros], 400);
        }

      });
    }
}
