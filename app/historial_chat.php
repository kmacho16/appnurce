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

}
