<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use App\Eventos;
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
         $mensajes = historial_chat::ultimosMensajes();
         $events = [];         
         $eventos = Eventos::select('nombre_evento','dia_completo','fecha_inicio','fecha_fin','id','color')->get();
         foreach ($eventos as $evento) {
         $events[] = \Calendar::event(
             $evento->nombre_evento, //event title
             $evento->dia_completo, //full day event?
             $evento->fecha_inicio, //start time (you can also use Carbon instead of DateTime)
             $evento->fecha_fin, //end time (you can also use Carbon instead of DateTime)
             $evento->id, //optionally, you can specify an event ID
              //optional event ID
             [
                 'url' => route('eventos.edit', $evento->id),
                 'color'=>'#'.$evento->color,
             ]
         );            
         }

         $calendario = \Calendar::addEvents($events) //add an array with addEvents
             ->setOptions([ //set fullcalendar options
                 'firstDay' => 1,
             ])->setCallbacks([]); 



        return view('mensajes.index',['mensajes'=>$mensajes,'calendario'=>$calendario]);
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
            $to_usuario = User::find($request->id_user);

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
    public function send(Request $request)
    {
        $user = User::find(5);
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
             'to' => $user->token_firebase,
             'data' => ["mensaje"=>"Una cosa"]
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
       return $result;
        
        
        return json_encode($user);
    }
}
