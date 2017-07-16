<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use App\historial_chat;

use Auth;
Use DB; 

class MensajesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $mensajes = historial_chat::join('users as us1','id_user','us1.id')
         ->join('users as us2','to_id_user','us2.id')
         ->select('historial_chat.*','us1.name as from_nombre','us2.name as to_nombre','us1.foto_perfil as from_img','us2.foto_perfil as to_img')
         ->where([['historial_chat.id_user',Auth::user()->id],['historial_chat.leido',false] ])
         ->orwhere([['historial_chat.to_id_user',Auth::user()->id],['historial_chat.leido',false] ])
         ->orderby('historial_chat.id','DESC')->get();
        return view('mensajes.index',['mensajes'=>$mensajes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $resultado = historial_chat::where([['id_user',Auth::user()->id],['to_id_user',$request->id_user]])->orwhere([['id_user',$request->id_user],['to_id_user',Auth::user()->id]])->groupBy('id_chat')->first();

            if(!empty($resultado)){
                $mensaje_previo = historial_chat::find($request->id_chat);
                $mensaje_previo->leido = true;
                $mensaje_previo->save();
                $id_chat = $resultado->id_chat;
                $mensaje = $request->comentario;
            }else{
                $id_chat = Chat::insertGetId(['id' => '']);
                $mensaje = "Un usuario ha solicitado tu informacion, sus datos de su servicio son los siguientes: <br> <strong>Fecha del servicio:</strong> $request->fecha <br> <strong>Direccion:</strong> $request->direccion <br> <strong>Observaciones:</strong> $request->comentario";
            }
            //return $mensaje;
            $mi_mensaje = new historial_chat;
            $mi_mensaje->id_chat = $id_chat;
            $mi_mensaje->id_user = Auth::user()->id;    
            $mi_mensaje->to_id_user = $request->id_user;
            $mi_mensaje->mensaje= $mensaje;
            $mi_mensaje->save();
        return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
