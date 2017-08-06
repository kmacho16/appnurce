<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\archivosUser;
use App\historial_chat;

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

use DB;
use Auth;

class RegisterController extends Controller
{


	use IssueTokenTrait;

	private $cliente;

	public function __construct (){
		$this->cliente = Client::find(1);
	}

    public function register(Request $request){
    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>'required|email|unique:users,email',
    		'password'=>'required|min:6'
    		]);
    		//dd($request->all());

    	$user = new User();
    	$user->name=$request->name;
    	$user->email=$request->email;
    	$user->password=bcrypt($request->password);
    	$user->save();


    	return $this->issueToken($request,'password');

    	/*$params = 	[
    		'grant_type'=>'password',
    		'client_id'=>$this->cliente->id,
    		'client_secret'=>$this->cliente->secret,
    		'username'=>$request->email,
    		'password'=>$request->password,
    		'scope'=>'*'
    	];

    	$request->request->add($params);
    	$proxy = Request::create('oauth/token','POST');

    	return Route::dispatch($proxy);*/


    }
}
