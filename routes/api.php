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

//Cabang
Route::get('/cabangs', 'CabangController@index');
Route::post('/cabangs/store', 'CabangController@store');
Route::get('/cabangs/{id}', 'CabangController@show');
Route::patch('cabangs/update/{id}', 'CabangController@update'); 
Route::delete('/cabangs/delete/{id}', 'CabangController@destroy');
