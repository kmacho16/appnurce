<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

Use DB; 

class ubicaciones extends Model
{
    protected $table = "ubicaciones";
    protected $fillable = [
        'id_user', 'latitud', 'longitud',
    ];

    public static function CalculaPuntos($lat,$lng,$box,$distance){
    	$ubicaciones =DB::select("select ubicaciones.id,users.name,nombre,id_user,latitud,longitud,(6371 * ACOS( 
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
    	                       having distancia < ? 
    	                       order by distancia ASC",[$lat,$lng,$lat,$box['min_lat'],$box['max_lat'],$box['min_lng'],$box['max_lng'],$distance]);//DESActive el STRICT
    	return $ubicaciones;
    }

    public static function getBoundaries($lat,$lng,$distance = 1, $eartradious = 6371){
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
