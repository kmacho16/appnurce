<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ubicaciones;
use Auth;
Use DB; 

class ubicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $misUbicaciones = ubicaciones::where('id_user',Auth::user()->id)->paginate(5);
        return view('ubicaciones.create',['ubicaciones'=>$misUbicaciones]);
    }

    public function createLocation($id){
       $misUbicaciones = ubicaciones::where('id_user',$id)->paginate(5);
        return view('ubicaciones.create',['ubicaciones'=>$misUbicaciones,'id_user'=>$id]);
    }

    public function storeLocation(Request $request,$id){
        //Comments::create($request->all());
        $ubicacion = new ubicaciones();
        $ubicacion->id_user = $id;
        $ubicacion->latitud = $request->latitud;
        $ubicacion->longitud = $request->longitud;        
        $ubicacion->nombre = $request->nombre;
        $ubicacion->save();
        return redirect("ubicacion/$id");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $misUbicaciones = ubicaciones::where('id_user',Auth::user()->id)->get();
        return view('ubicaciones.create',['ubicaciones'=>$misUbicaciones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Comments::create($request->all());
        $ubicacion = new ubicaciones();
        $ubicacion->id_user = Auth::user()->id;
        $ubicacion->latitud = $request->latitud;
        $ubicacion->longitud = $request->longitud;        
        $ubicacion->nombre = $request->nombre;
        $ubicacion->save();

        return redirect('ubicaciones');
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
        $miUbicacion = ubicaciones::find($id);
        return view('ubicaciones.edit',['ubicacion'=>$miUbicacion]);
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
        $ubicacion = ubicaciones::find($id);
        $ubicacion->latitud = $request->latitud;
        $ubicacion->longitud = $request->longitud;        
        $ubicacion->nombre = $request->nombre;
        $ubicacion->save();

        if($ubicacion->id_user == Auth::user()->id){
            return redirect('ubicaciones');
        }else{
            return redirect("ubicacion/$ubicacion->id_user");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ubicacion = ubicaciones::find($id);
        $ubicacion->delete();
        if($ubicacion->id_user == Auth::user()->id){
            return redirect('ubicaciones');
        }else{
            return redirect("ubicacion/$ubicacion->id_user");
        }
    }

    public function ubicacionesFind(Request $request){
        $lat= $request->latBus;
        $lng=$request->lngBus;
        $distance = $radio = $request->radio;
        $box = ubicaciones::getBoundaries($lat,$lng,$distance);
        $ubicaciones =ubicaciones::CalculaPuntos($lat,$lng,$box,$distance);
        return view('ubicaciones.find',['lat'=>$lat,'lng'=>$lng,'radio'=>$radio,'ubicacionesFind'=>$ubicaciones]);
    }

}
