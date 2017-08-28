<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\User;
use App\historial_chat;
use Auth;
use DB;

use App\ubicaciones;

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{


	 public function userApi(){
        $usuario  = User::select("*")->where('id',Auth::user()->id)->get();//find();
        //dd($usuario->all());
        return Response()->json(['data'=>$usuario],200,[],JSON_NUMERIC_CHECK);
    }

    public function editUser(Request $request){
        $this->validate($request,['name'=>['required','min:3'],'email'=>['required',Rule::unique('users')->ignore(Auth::user()->id)]]);
        $user  = User::find(Auth::user()->id);
        
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;

        if (empty($request->password)) {
            $user->password = $user->password;
        }else{
            $user->password = bcrypt($request->password);
        }

       if(empty($request->foto_perfil) || $request->foto_perfil==''){
            $user->foto_perfil = $user->foto_perfil;
        }else{
            Storage::delete($user->foto_perfil);
        	$miFoto = base64_decode($request->foto_perfil);
        	file_put_contents('../public/uploads/usuarios/'.$user->id.'.jpg', $miFoto);
            $user->foto_perfil = "usuarios/".$user->id.".jpg";
        }

        $user->save();
        return Response()->json(["respuesta"=>"ok","state"=>200]);
    }

    public function findPersonal(Request $request){
	 	$lat= $request->lat;
        $lng=$request->lng;
        $distance = $radio = $request->radio;
        $box = ubicaciones::getBoundaries($lat,$lng,$distance);
      /*  return json_encode($box);*/
        $ubicaciones =ubicaciones::CalculaPuntos($lat,$lng,$box,$distance);
        return Response()->json(['data'=>$ubicaciones],200,[],JSON_NUMERIC_CHECK);

    }
    public function findProfile(Request $request){
        $usuario  = User::select("*")->where('id',$request->id_profile)->get();//find();
        //dd($usuario->all());
        return Response()->json(['data'=>$usuario],200,[],JSON_NUMERIC_CHECK);
    }

    public function chatAll(){
        $mensajes  = historial_chat::ultimosMensajes();     
        return Response()->json(['data'=>$mensajes],200,[],JSON_NUMERIC_CHECK);
    }

    public function chatPersonal(Request $request){
        $mensajes = historial_chat::mensajesFromUser($request->id);
        return Response()->json(['data'=>$mensajes],200,[],JSON_NUMERIC_CHECK);
    }

    public function sendMensaje(Request $request){
        $id_chat = $request->id_chat;
        $to_id_user = $request->to_id_user;
        $mensaje = $request->mensaje;

        $mensaje_previo = historial_chat::where('id_chat',$id_chat)->orderby('id','DESC')->first();
        $mensaje_previo->leido = true;
        $mensaje_previo->save();    
        
        $mi_mensaje = new historial_chat;
        $mi_mensaje->id_chat = $id_chat;

        $mi_mensaje->id_user = Auth::user()->id; 
        $mi_mensaje->to_id_user = $to_id_user;
        $mi_mensaje->mensaje = $mensaje;

        $to_usuario = User::find($to_id_user);
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
        
        return Response()->json(["respuesta"=>"ok","state"=>200]);
    }

    public function ubicacionesPersonal(Request $request){
        $misUbicaciones = ubicaciones::where('id_user',Auth::user()->id)->get();
        return Response()->json(['data'=>$misUbicaciones],200,[],JSON_NUMERIC_CHECK);
    }
    public function storeUbicaciones(Request $request){
        $ubicacion = new ubicaciones();
        $ubicacion->id_user = Auth::user()->id;
        $ubicacion->latitud = $request->latitud;
        $ubicacion->longitud = $request->longitud;        
        $ubicacion->nombre = $request->nombre;
        $ubicacion->save();
        return Response()->json(["respuesta"=>"ok","state"=>200]);
    }

    public function deleteUbicaciones(Request $request){
        $ubicacion = ubicaciones::find($request->id);
        $ubicacion->delete();
        return Response()->json(["respuesta"=>"ok","state"=>200]);
    }
}
