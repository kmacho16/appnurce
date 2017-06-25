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

/*********USERS**************/
Route::get('perfil','UserController@editProfile');
Route::post('filesUser/{id}','UserController@files');
Route::delete('filesUserDestroy/{id_campo}','UserController@filesDestroy');
