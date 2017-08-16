<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

class LoginController extends Controller
{

	use IssueTokenTrait;

	private $cliente;

	public function __construct (){
		$this->cliente = Client::find(1);
	}

    public function login(Request $request){
    	$this->validate($request,[
    		'username'=>'required',
    		'password'=>'required'
    		]);

        $user = user::where('email',$request->username)->first();
        $user->token_firebase = $request->token_firebase;
        $user->save();
        /*echo $user;
        exit();*/

    	return $this->issueToken($request,'password');

    	/*$params = 	[
    		'grant_type'=>'password',
    		'client_id'=>$this->cliente->id,
    		'client_secret'=>$this->cliente->secret,
    		'username'=>$request->username,
    		'password'=>$request->password,
    		'scope'=>'*'
    	];

    	$request->request->add($params);
    	$proxy = Request::create('oauth/token','POST');

    	return Route::dispatch($proxy);*/
    }

    public function refresh(Request $request){
		$this->validate($request,[
		    		'refresh_token'=>'required'
		    		]);


    	return $this->issueToken($request,'refresh_token');

    	/*$params = 	[
    		'grant_type'=>'refresh_token',
    		'client_id'=>$this->cliente->id,
    		'client_secret'=>$this->cliente->secret,
    		'username'=>$request->username,
    		'password'=>$request->password
    	];

    	$request->request->add($params);
    	$proxy = Request::create('oauth/token','POST');

    	return Route::dispatch($proxy);*/
    }

    public function logout(Request $request){
    	
    	$accessToken = Auth::user()->token();
    	DB::table('oauth_refresh_tokens')
    		->where('access_token_id', $accessToken->id)
    		->update(['revoked' => true]);
    	$accessToken->revoke();
    	return response()->json([], 204);

    }
}
