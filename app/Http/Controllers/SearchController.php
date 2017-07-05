<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ubicaciones;
use Auth;
Use DB; 

class SearchController extends Controller
{
    public function index(Request $request)
    {
    	$lat= $request->lat;
        $lng=$request->lng;
        $distance = $radio = $request->radio;
        $box = ubicaciones::getBoundaries($lat,$lng,$distance);
        $ubicaciones =ubicaciones::CalculaPuntos($lat,$lng,$box,$distance);
        return view('search',["ubicaciones"=>$ubicaciones]);
    }
}
