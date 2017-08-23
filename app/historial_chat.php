<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;

class historial_chat extends Model
{
    //

    protected $table = "historial_chat";

    public static function cantidadMensajes(){
    	$cantidad  = DB::table('historial_chat')->select(DB::raw('count(*) as total'))->where([['leido',false],['to_id_user',Auth::user()->id]])->get();
    	return $cantidad;
    }

    public static function ultimosMensajes(){
    	$mensajes  = DB::table('historial_chat')
    	->join('users as us1','id_user','us1.id')
    	->join('users as us2','to_id_user','us2.id')
    	->select('historial_chat.*','us1.name as from_nombre','us2.name as to_nombre','us1.foto_perfil as from_img','us2.foto_perfil as to_img')
    	->where([['historial_chat.id_user',Auth::user()->id],['historial_chat.leido',false]])
    	->orwhere([['historial_chat.to_id_user',Auth::user()->id],['historial_chat.leido',false] ])
    	->orderby('historial_chat.id','DESC')->get();
    	return $mensajes;
    }

    public static function mensajesFromUser($id){
    	$mensajes = DB::table('historial_chat')->select('historial_chat.*','users.foto_perfil')
        ->join('users','id_user','users.id')
        ->where('id_chat',$id)->orderBy('id','DESC')->limit(10)->get();
        return $mensajes;
    }

}
