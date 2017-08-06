<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Event;

use App\User;
use App\ubicaciones;
use App\Eventos;
use Auth;
Use DB; 


class eventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        return view('eventos.index',['calendario'=>$calendario]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $eventos = new Eventos();
        $eventos->id_user = Auth::user()->id;

        if ($request->to_id_user == null) {
            $eventos->to_id_user =  Auth::user()->id;
        }else{
            $eventos->to_id_user =$request->to_id_user;
        };

        //return $eventos->to_id_user;

        $eventos->nombre_evento = $request->nombre_evento;
        $eventos->color = $request->mi_color;

        $eventos->descripcion = $request->descripcion;
        if ($request->all_day) {
            $all_day = true;
        }else{
            $all_day = false;
        }

        $eventos->dia_completo = $all_day;
        $eventos->fecha_inicio = $request->f_ini." ".$request->h_ini;        
        $eventos->fecha_fin = $request->f_fin." ".$request->h_fin;
        $eventos->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evento = Eventos::select('eventos.*','users.name')->join('users','users.id','to_id_user')->where([['eventos.id',$id],['eventos.id_user',Auth::user()->id]])->first();//find($id);
        //return $evento;
        //return $evento;
        return view('eventos.edit',['evento'=>$evento]);
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
        $eventos = Eventos::find($id);
        $eventos->id_user = Auth::user()->id;

        if ($request->to_id_user == null) {
            $eventos->to_id_user =  Auth::user()->id;
        }else{
            $eventos->to_id_user =$request->to_id_user;
        };
        
        $eventos->nombre_evento = $request->nombre_evento;
        $eventos->descripcion = $request->descripcion;
        
        $eventos->color = $request->color;

        if ($request->dia_completo) {
            $all_day = true;
        }else{
            $all_day = false;
        }

        $eventos->dia_completo = $all_day;
        $eventos->fecha_inicio = $request->f_ini." ".$request->h_ini;        
        $eventos->fecha_fin = $request->f_fin." ".$request->h_fin;
        $eventos->save();

        return redirect('eventos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $eventos = Eventos::find($id);
         $eventos->delete();

        return redirect('eventos');

    }
}
