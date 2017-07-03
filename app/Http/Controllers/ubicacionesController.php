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
        $distance = 10;
        $box = $this->getBoundaries($lat,$lng,$distance);
        $ubicaciones =DB::select("select users.name,nombre,id_user,latitud,longitud,min(6371 * ACOS( 
                                            SIN(RADIANS(latitud)) 
                                            * SIN(RADIANS(?)) 
                                            + COS(RADIANS(longitud - ?)) 
                                            * COS(RADIANS(latitud)) 
                                            * COS(RADIANS(?))
                                            )
                               ) AS distancia 
                               from ubicaciones inner join users on ubicaciones.id_user  = users.id
                               where (latitud between ? and ? )
                               and (longitud between ? and ? )
                               GROUP BY id_user
                               having distancia < ? 
                               order by distancia ASC",[$lat,$lng,$lat,$box['min_lat'],$box['max_lat'],$box['min_lng'],$box['max_lng'],$distance]);//DESActive el STRICT
        return $ubicaciones;
    }

    public function getBoundaries($lat,$lng,$distance = 1, $eartradious = 6371){
        $retorno = array();

        //Los angulos para cada direccion 
        $coordinalCoords = array('north' =>'0','south'=>'180','east'=>'90','west'=>'270');

        $rlat = deg2rad($lat);
        $rlng = deg2rad($lng);
        $angDist = $distance/$eartradious;

        foreach ($coordinalCoords as $name => $angulo) {
            $rAngulo = deg2rad($angulo);
            $rlatb = asin(sin($rlat)*cos($angDist) + cos($rlat)*sin($angDist)*cos($rAngulo));
            $rlngb = $rlng + atan2(sin($rAngulo) * sin($angDist) * cos($rlat), cos($angDist) - sin($rlat) * sin($rlatb));
            $retorno[$name] = array('lat'=>(float) rad2deg($rlatb),'lng'=>(float)rad2deg($rlngb));
        }

        return array('min_lat'  => $retorno['south']['lat'],
                 'max_lat' => $retorno['north']['lat'],
                 'min_lng' => $retorno['west']['lng'],
                 'max_lng' => $retorno['east']['lng']);
    }
}
