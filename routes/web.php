<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/chart', function () {
    return view('chart.chart');
});

Route::get('/respuesta','RespuestaController@index');
Route::get('/users','UserController@index');
Route::get('/all','UserController@usersAll');

Route::get('/users/get','UserController@selectUsers');
Route::put('/users/post','UserController@store');
Route::get('/get/user','ParticipacionController@getUser');
Route::get('/reporte', 'UserController@selectReporte');
Route::get('/pregunta', 'PreguntaController@index');
Route::get('/encuesta', 'EncuestaController@index');
Route::get('/getencuesta', 'EncuestaController@getEncuestas');
Route::get('/participacion', 'ParticipacionController@index');
Route::post('/registrar','EncuestaController@store');
Route::put('/actualizar', 'UserController@update');


