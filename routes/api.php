<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/autos','AutoController@all');
Route::post('/autos','AutoController@store');
Route::get('/autos/destroy/{auto_id}', 'AutoController@destroy');
Route::put('/autos/editar/{id}', 'AutoController@update');
Route::get('/auto/show/{auto}', 'AutoController@show');
Route::get('/auto/servicio/{id_car}', 'AutoController@historial');

Route::get('/colors','ColorController@all');
Route::post('/colors','ColorController@store');


Route::get('/marcas','MarcaController@all');


Route::get('/modelos','ModeloController@all');


Route::get('/propietarios','PropietarioController@all');
Route::post('/propietarios','PropietarioController@store');

Route::get('/servicios','ServicioController@all');
Route::post('/servicio','ServicioController@store');