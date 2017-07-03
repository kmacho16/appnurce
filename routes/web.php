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

Auth::routes();	

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/usuarios','UserController');
Route::resource('/ubicaciones','ubicacionesController');

Route::get('/ubicacion/{id}','ubicacionesController@createLocation');
Route::post('/ubicacionStore/{id}','ubicacionesController@storeLocation');
Route::get('/ubicacionEdit/{id}','ubicacionesController@editLocation');

Route::post('/ubicacionFind','ubicacionesController@ubicacionesFind');

/*********USERS**************/
Route::get('perfil','UserController@editProfile');
Route::post('filesUser/{id}','UserController@files');
Route::delete('filesUserDestroy/{id_campo}','UserController@filesDestroy');
