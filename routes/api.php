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


Route::get('/colors','ColorController@all');
Route::post('/colors','ColorController@store');


Route::get('/marcas','MarcaController@all');


Route::get('/modelos','ModeloController@all');


Route::get('/propietarios','PropietarioController@all');
Route::post('/propietarios','PropietarioController@store');

Route::get('/servicios','ServicioController@all');