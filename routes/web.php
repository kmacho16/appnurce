<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});

Route::get('/search','SearchController@index');

Auth::routes();	

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/usuarios','UserController');
Route::get('/profile','UserController@showProfile');
Route::resource('/ubicaciones','ubicacionesController');
Route::resource('/mensajes','MensajesController');

Route::get('/ubicacion/{id}','ubicacionesController@createLocation');
Route::post('/ubicacionStore/{id}','ubicacionesController@storeLocation');
Route::get('/ubicacionEdit/{id}','ubicacionesController@editLocation');
Route::post('/ubicacionFind','ubicacionesController@ubicacionesFind');

Route::get('perfil','UserController@editProfile');

Route::post('filesUser/{id}','UserController@files');
Route::delete('filesUserDestroy/{id_campo}','UserController@filesDestroy');



/* RUTAS PARA LOS AJAX**/
Route::post('consultarChat','ajaxController@consultaChat');
Route::post('enviarMensaje','ajaxController@enviarMensaje');
