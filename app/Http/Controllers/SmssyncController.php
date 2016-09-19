<?php

namespace App\Http\Controllers;

use App\smssync_message;
use Illuminate\Http\Request;

use App\Http\Requests;

class SmssyncController extends Controller
{

    public function __construct()
    {

    }

    function index(Request $request)
    {
        $task = (isset($request['task'])) ? $request['task'] : "";

        switch ($task) {
            // enviar
            case "send":
                $this->_send();
                break;

            // Receber
            default:
                $this->_receive();
                break;
        }
    }
   //por implementar
    private function _receive()
    {

    }

    private function _send()
    {
        $reply =  array();

        // Carrega da BD todas mensagens nao enviadas
        $messages = \App\smssync_message::where("smssync_sent", 0);

        foreach ($messages as $message)
        {
            $reply[] = array(
                "to"=>$message->smssync_to,
                "message"=>$message->smssync_message
            );

            $message->smssync_sent = 1;
            $message->smssync_sent_date = date("Y-m-d H:i:s",time());
            $message->save();
        }

        //get the secret key
        $smssync_secret = \App\smssync_settings()->find(1);

        if ($smssync_secret->loaded)
        {
            $smssync_secret = $smssync_secret->smssync_secret;
        }
        else
        {
            //secret vazia, porque nao foi definida.
            $smssync_secret = "";
        }

        $response = json_encode(
            ["payload"=>[
                "success"=>"true",
                "task"=>"send",
                "secret" => $smssync_secret,
                "messages"=>array_values($reply)]
            ]);
        send_response($response);
    }
    function send_response($response)
    {
        // Avoid caching
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        header("Content-type: application/json; charset=utf-8");
        echo $response;
    }
}
