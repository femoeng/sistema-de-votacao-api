<?php

namespace App\Http\Controllers;

use App\smssync_message;
use Illuminate\Http\Request;

use App\Http\Requests;

class SmssyncController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('validar_url', ['only' => ['task']]);
        $this->middleware('validar_conteudo', ['only' => ['task']]);

    }

    function task()
    {
        $task = $this->request['task'];

        switch ($task) {
            // enviar
            case "send":
                $this->_send();
                break;

            // Receber
            default:
                $this->_receive($this->request);
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Message = \App\SmssyncMessage::findOrFail($id);
        return $Message;
    }

    public function index()
    {
        $mensagens = \App\SmssyncMessage::all();

        $mensagem = $this->request->visitante;

        if (count($mensagens) > 0) {
            return  [
                'mensagem' => $mensagens
            ];


        } else {
            abort(404);

        }
    }

    
    private function _receive(Request $request)
    {
        $error = NULL;

        // Set success to false as the default success status

        $success = false;

        /**
         *  Numero de celular da mensagem enviada.
         */

            $from = $request['from'];


        /**
         * Get the SMS aka the message sent.
         */

            $message = $$request['message'];


        /**
         * hora em que a mensagme foi enviada SMS
         */

            $sent_timestamp = $$request['sent_timestamp'];

        /**
         * Get the phone number of the device SMSsync is
         * installed on.
         */

            $sent_to = $$request['sent_to'];

            //gravando a mensagem enviada

            $message_data=new \App\smssync_message();
            $message_data=[
                'from' => $from,
                'message'  => $message,
                'sent_to'  => $sent_to,
                'sent_timestamp'  => $sent_timestamp,
            ];
            $message_data->save();

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

        $response = json_encode(
            ["payload"=>[
                "success"=>"true",
                "task"=>"send",
                "secret" => "",
                "messages"=>array_values($reply)]
            ]);
        send_response($response);
    }

}
