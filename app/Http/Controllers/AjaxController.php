<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use App\historial_chat;

use Auth;


class AjaxController extends Controller
{
    public function consultaChat(Request $request){
    	$mensajes = historial_chat::mensajesFromUser($request->id);
    	return response()->json($mensajes->toArray());
    }

    public function enviarMensaje(Request $request){

        $ids = explode('-', $request->ids);
           
        $mensaje_previo = historial_chat::find($ids[2]);
        $mensaje_previo->leido = true;
        $mensaje_previo->save();

        $id_chat = $ids[0];
        $mensaje = $request->mensaje;

        
        $mi_mensaje = new historial_chat;
        $mi_mensaje->id_chat = $id_chat;

        $mi_mensaje->id_user = Auth::user()->id; 
        $mi_mensaje->to_id_user = $ids[1];
        $mi_mensaje->mensaje= $mensaje;

        $to_usuario = User::find($ids[1]);

        if ($to_usuario->token_firebase) {
                $url = 'https://fcm.googleapis.com/fcm/send';
                $fields = array(
                     'to' => $to_usuario->token_firebase,
                     'data' => ["mensaje"=>$mensaje]
                    );
                $headers = array(
                    'Authorization:key = AAAAa6yZpc4:APA91bHGQIOORGgj18Yjbm-k9JvnqYRf0Kjfzy2q4H12HqSvwpYakmN31v0skT2GCElsCR7zBeSzeaypUbmpfO4yDaS9Zb3UBOWdgJ1Q8rKQ2A1265jV4x0BCKn7qFq6pqzpeajpPnHe',
                    'Content-Type:application/json'
                    );

                $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_POST, true);
               curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
               curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
               $result = curl_exec($ch);           
               if ($result === FALSE) {
                   die('Curl failed: ' . curl_error($ch));
               }
               curl_close($ch);
                //return $result;
                //return json_encode($user);
            }

        $mi_mensaje->save();
        return  "Ok";
    }
}

/*
return response()->json($comentarios->toArray());*/