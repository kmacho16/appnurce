<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\User;
use Auth;
use DB;

use App\ubicaciones;

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

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

       /* if(empty($request->foto_perfil)){
            $user->foto_perfil = null;
        }else{
        	$miFoto = base64_decode($request->foto_perfil);
        	file_put_contents('/uploads/archivo.jpg', $miFoto);
            //$user->foto_perfil = $request->file($miFoto)->store('usuarios'); 
        }*/

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
}
