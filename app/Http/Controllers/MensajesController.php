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
        //
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
            $resultado = historial_chat::where([['id_user',Auth::user()->id],['to_id_user',$request->id_user]])->get();

            if(!$resultado->isEmpty()){
                $mensaje="ya habias enviado un mensaje ";
                return $mensaje;
            }else{
                $id_chat = Chat::insertGetId(['id' => '']);
                $mi_mensaje = new historial_chat;
                $mensaje = "Hola tienes una solicitud con los siguientes datos: <br> <strong>Fecha del servicio:</strong> $request->fecha <br> <strong>Direccion:</strong> $request->direccion <br> <strong>Observaciones:</strong> $request->comentario";
                $mi_mensaje->id_chat = $id_chat;
                $mi_mensaje->id_user = Auth::user()->id;    
                $mi_mensaje->to_id_user = $request->id_user;
                $mi_mensaje->mensaje= $mensaje;
                $mi_mensaje->save();
            }
            

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
