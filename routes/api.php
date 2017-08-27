<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register','Api\Auth\RegisterController@register');
Route::post('login','Api\Auth\LoginController@login');
Route::post('refresh','Api\Auth\LoginController@refresh');


Route::middleware('auth:api')->group(function () {
   	Route::GET('usuario','Api\ApiController@userApi');   
   	Route::post('logout','Api\Auth\LoginController@logout');
	Route::post('usuario/editar','Api\ApiController@editUser');
	Route::post('personal/find','Api\ApiController@findPersonal');
	Route::post('personal/profile','Api\ApiController@findProfile');


	Route::get('chat/all','Api\ApiController@chatAll');
	Route::post('chat/personal','Api\ApiController@chatPersonal');
	Route::post('chat/mensaje','Api\ApiController@sendMensaje');


	Route::get('ubicaciones/personal','Api\ApiController@ubicacionesPersonal');

});
