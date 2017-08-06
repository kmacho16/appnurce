<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

Use DB;
use Auth; 

class ubicaciones extends Model
{
    protected $table = "ubicaciones";
    protected $fillable = [
        'id_user', 'latitud', 'longitud',
    ];

    public static function CalculaPuntos($lat,$lng,$box,$distance){
        $mlat = (float)$lat;
        $mlng = (float)$lng;

        $consulta = "";
        if (Auth::check()) {
            $consulta = "and  users.id != ".Auth::user()->id; 
        }
        
    	/*$ubicaciones =DB::select("select ubicaciones.id,users.name,users.foto_perfil as img_perfil,nombre,id_user,latitud,longitud,(6371 * ACOS( 
    	                                    SIN(RADIANS(latitud)) 
    	                                    * SIN(RADIANS(?)) 
    	                                    + COS(RADIANS(longitud - ?)) 
    	                                    * COS(RADIANS(latitud)) 
    	                                    * COS(RADIANS(?))
    	                                    )
    	                       ) AS distancia 
    	                       from ubicaciones inner join users on ubicaciones.id_user = users.id and users.id_rol = 2 ".$consulta."  
    	                       where (latitud between ? and ? )
    	                       and (longitud between ? and ? )
                               group by  users.id 
    	                       having distancia < ? 
    	                       order by distancia ASC",[$mlat,$lng,$lat,$box['min_lat'],$box['max_lat'],$box['min_lng'],$box['max_lng'],$distance]);//DESActive el STRICT*/

            $ubicaciones =DB::select("select ubicaciones.id,users.name,users.foto_perfil as img_perfil,nombre,id_user,latitud,longitud,(6371 * ACOS( 
                                                SIN(RADIANS(cast(latitud as double precision)) 
                                                * SIN(RADIANS(?)) 
                                                + COS(RADIANS(longitud - ?)) 
                                                * COS(RADIANS(latitud)) 
                                                * COS(RADIANS(?))
                                                )
                                   ) AS distancia 
                                   from ubicaciones inner join users on ubicaciones.id_user = users.id and users.id_rol = 2 ".$consulta."  
                                   where (latitud between ? and ? )
                                   and (longitud between ? and ? )
                                   group by  users.id 
                                   having distancia < ? 
                                   order by distancia ASC",[$mlat,$mlng,$mlat,$box['min_lat'],$box['max_lat'],$box['min_lng'],$box['max_lng'],$distance]);//DESActive el STRICT
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

/*select ubicaciones.id,users.name,users.foto_perfil as img_perfil,nombre,id_user,latitud,longitud,(6371 * ACOS( SIN(RADIANS(latitud)) * SIN(RADIANS(4.682764486812419)) + COS(RADIANS(longitud - -74.07964969389036)) * COS(RADIANS(latitud)) * COS(RADIANS(4.682764486812419)) ) ) AS distancia from ubicaciones inner join users on ubicaciones.id_user = users.id and users.id_rol = 2 where (latitud between 4.6377984065165 and 4.7277305671084 ) and (longitud between -74.124766374046 and -74.034533013735 ) having distancia < 5 order by distancia ASC*/