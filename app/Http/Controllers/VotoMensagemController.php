<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Log;

class VotoMensagemController extends Controller
{
  public function __construct() {

  }

  public function store(Request $request) {
    $accao = $request->only('task');
    if (isset($accao['task'])) {
      if ($accao['task'] == 'sent') {
        $data = $request->json()->all();
        $mensagens = $data['queued_messages'];
        foreach($mensagens as $m) {
          \App\Messagem::destroy($m);
        }
      }
    } else {
      $dados = $request->only('from', 'message');
      if (isset($dados['from']) && isset($dados['message'])) {
        $from = substr($dados['from'], -9);
        $visitante = \App\Visitante::where('contacto', $from)->first();

        if (isset($visitante)) {
          if (!$visitante->votou) {
            if (preg_match('/([cC]\\w+)\\s+([pP]\\d+)(,([cC]\\d+)\\s+([pP]\\d+))*/', $dados['message'])) {
              $smss = explode(',', $dados['message']);
              foreach ($smss as $sms) {
                $mens = explode(' ', $sms);
                $criterio_id = substr($mens[0], 1);
                $projecto_id = substr($mens[1], 1);

                $criterio = \App\Criterio::find($criterio_id);

                if (isset($criterio)) {
                  $vs = \App\Voto::where('visitante_id', $visitante->id)->where('criterio_id', $criterio->id)->count();

                  if ($vs == 0) {
                    $projecto = \App\Projecto::find($projecto_id);
                    if (isset($projecto)) {
                      \App\Voto::create([
                        'visitante_id' => $visitante->id,
                        'projecto_id' => $projecto->id,
                        'criterio_id' => $criterio->id,
                      ]);

                      return ['tudo certo'];
                      // Enviar mensagem de sucesso
                    }
                  } else {
                    return ['ja votou neste criterio'];
                    // Enviar SMS de erro
                  }

                } else {
                  // Criterio nao existente
                  return ['tudo certo'];
                }
              }
            } else {
              // Enviar SMS de erro
              return ['Formato de mensagem errado'];
            }
          } else {
            return ['Ja votou'];
          }
        } else {
            return ['Visitante nao existe'];
        }
      } else {
        return ['formato de entrada errada'];
      }
    }
  }

  public function index(Request $request) {
    $filters = $request->input('task');
    if (isset($filters['task'])) {
      if ($filters['task'] == 'send') {
        $mensagens = \App\Mensagem::all();
        $sent = [
          'payload' => [
            'task' => 'send',
            'secret' => 'femoeng',
            'messages' => []
          ]
        ];

        foreach ($mensagens as $m) {
          $mm = [
            'to' => $m['contacto'],
            'message' => $m['mensagem'],
            'uuid' => $m['id']
          ];

          array_push($sent['payload']['messages'], $mm);
        }

        return $sent;
      } else {

        return [
          'payload' => [
            'success' => false,
            'message' => ''
          ]
        ];

      }
    } else {

      return [
        'payload' => [
          'success' => false,
          'message' => ''
        ]
      ];

    }
  }
}
