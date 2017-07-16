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
    	$mensajes = historial_chat::select('historial_chat.*','users.foto_perfil')
    	->join('users','id_user','users.id')
    	->where('id_chat',$request->id)->orderBy('id','DESC')->limit(10)->get();

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
        $mi_mensaje->save();
        return  "Ok";
    }
}

/*
return response()->json($comentarios->toArray());*/