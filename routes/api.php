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

Route::group(['prefix' => 'bailleur'], function() {
    Route::post('/','BailleurController@create');
    Route::post('/{id}', 'BailleurController@update');
    Route::delete('/{id}','BailleurController@destroy');
    Route::get('/','BailleurController@index');
    Route::get('/{id}','BailleurController@find');
});

Route::group(['prefix' => 'maison'], function() {
    Route::post('/','MaisonController@create');
    Route::post('/{id}', 'MaisonController@update');
    Route::delete('/{id}','MaisonController@destroy');
    Route::get('/','MaisonController@index');
    Route::get('/{id}','MaisonController@find');
});

Route::group(['prefix' => 'type'], function() {
    Route::post('/','TypeController@create');
    Route::post('/{id}', 'TypeController@update');
    Route::delete('/{id}','TypeController@destroy');
    Route::get('/','TypeController@index');
    Route::get('/{id}','TypeController@show');
});
