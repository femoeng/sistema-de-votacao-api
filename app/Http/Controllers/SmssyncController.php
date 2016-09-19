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
                $this->_receive($request);
                break;
        }
    }
   //por implementar
    private function _receive(Request $request)
    {
        $error = NULL;
        // Set success to false as the default success status

        $success = false;

        /**
         *  Get the phone number that sent the SMS.
         */
        if (isset($request['from']))
        {
            $from = $request['from'];
        }
        else
        {
            $error = 'The from variable was not set';
        }
        /**
         * Get the SMS aka the message sent.
         */
        if (isset($$request['message']))
        {
            $message = $$request['message'];
        }
        else
        {
            $error = 'The message variable was not set';
        }
        /**
         * Get the secret key set on SMSsync side
         * for matching on the server side.
         */
        if (isset($$request['secret']))
        {
            $secret = $$request['secret'];
        }
        /**
         * Get the timestamp of the SMS
         */
        if(isset($$request['sent_timestamp']))
        {
            $sent_timestamp = $$request['sent_timestamp'];
        }
        /**
         * Get the phone number of the device SMSsync is
         * installed on.
         */
        if (isset($$request['sent_to']))
        {
            $sent_to = $$request['sent_to'];
        }
        /**
         * Get the unique message id
         */
        if (isset($$request['message_id']))
        {
            $message_id = $$request['message_id'];
        }
        /**
         * Get device ID
         */
        if (isset($$request['device_id']))
        {
            $device_id = $$request['device_id'];
        }
        /**
         * Now we have retrieved the data sent over by SMSsync
         * via HTTP. Next thing to do is to do something with
         * the data. Either echo it or write it to a file or even
         * store it in a database. This is entirely up to you.
         * After, return a JSON string back to SMSsync to know
         * if the web service received the message successfully or not.
         *

         */
        if ((strlen($from) > 0) AND (strlen($message) > 0) AND
            (strlen($sent_timestamp) > 0 )
            AND (strlen($message_id) > 0))
        {
            /* The screte key set here is 123456. Make sure you enter
             * that on SMSsync.
             */
            if ( ( $secret == \App\smssync_settings::find(1)))
            {
                $success = true;
            } else
            {
                $error = "The secret value sent from the device does not match the one on the server";
            }
            //gravacao da mensagem enviada usando txt
            $message_data=new \App\smssync_message();
            $message_data=[
                'from' => $from,
                'message'  => $message,
                'sent_to'  => $sent_to,
                'device_id'  => $device_id,
                'sent_timestamp'  => $sent_timestamp,
            ];
            $message_data->save();


    }
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
