<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\archivosUser;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $rules = [
    'name'=>['required','min:3'],
    'email'=>['required','email','unique:users'],
    'password'=>['required','min:4','max:15']
    ];


    public function index(Request $request)
    {
        $usuario = User::searchMode($request->search,$request->type);
        //$usuario = User::all();

        $roles = DB::table('roles')->pluck('rol','id');
        return view("users.index",['user'=>$usuario,'roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = DB::table('roles')->pluck('rol','id');
        return view("users.create",['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,$this->rules);
        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->telefono = $request->telefono;        
        $user->id_rol = $request->id_rol;

        if(empty($request->foto_perfil)){
            $user->foto_perfil = null;
        }else{
            $user->foto_perfil = $request->file('foto_perfil')->store('usuarios'); 
        }

        $user->save();
        return redirect("usuarios");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $usuario  = User::find($id);
        return view('users.show',['usuario'=>$usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario  = User::find($id);
        $userarc = archivosUser::where('id_user',$id)->orderby('id_campo','ASC')->get();
        //$archivosUser = archivosUser::find());

        $roles = DB::table('roles')->pluck('rol','id');

        return view("users.edit",["usuario"=>$usuario,'archivos'=>$userarc,'roles'=>$roles]);
        
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
        $this->validate($request,['name'=>['required','min:3'],'email'=>['required',Rule::unique('users')->ignore($id)]]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;        
        $user->id_rol = $request->id_rol;

        if (empty($request->password)) {
            $user->password = $user->password;
        }else{
            $user->password = bcrypt($request->password);
        }

        if(empty($request->foto_perfil)){
            $user->foto_perfil =  $user->foto_perfil;
        }else{
            $user->foto_perfil = $request->file('foto_perfil')->store('usuarios'); 
        }



        $user->save();
        return redirect("usuarios");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();
        return redirect("usuarios");
    }


    public function editProfile(){
        return view("usuarios.edit");
    }

    public function files(Request $request,$id){
        for ($i=1; $i <=6 ; $i++) {
            if (!empty($request->file("documento$i"))){
                $userarc = archivosUser::where('id_campo',$id.''.$i)->first();
                if(empty($userarc)){
                    $userarc1 = new archivosUser();
                    $userarc1->id_user = $id;
                    $userarc1->id_campo = $id.''.$i;
                    $userarc1->ruta = $request->file("documento$i")->store("documentos/$id");
                    $userarc1->save();
                }else{
                    $userarc2 = archivosUser::find($userarc->id);
                    $userarc2->ruta = $request->file("documento$i")->store("documentos/$id");
                    $userarc2->save();
                }
            }
        }
        return back()->with('mensajes','Documentos actualizados correctamente');
    }

    public function filesDestroy($id_campo){
        $archivo = archivosUser::where('id_campo',$id_campo)->first();
        //$archivo = archivosUser::find($userarc->id);
        $archivo->delete();
        return back()->with('mensajes','Documentos Eliminados correctamente');
    }
}
