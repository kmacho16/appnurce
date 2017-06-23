<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;

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


    public function index()
    {
        $usuario = User::all();
        return view("users.index",['user'=>$usuario]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
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
        if(empty($request->foto_perfil)){
            $user->foto_perfil = null;
        }else{
            $user->foto_perfil = $request->file('foto_perfil')->store('usuarios'); 
        }

        $user->save();
        return redirect("user");
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
        $usuario  = User::find($id);
        return view("users.edit",["usuario"=>$usuario]);
        
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
        return redirect("user");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function editProfile(){
        return view("users.edit");
    }
}
