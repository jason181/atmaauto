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
Route::get('/cabangs/{id}', 'CabangController@showbyID');
Route::patch('/cabangs/update/{id}', 'CabangController@update'); 
Route::delete('/cabangs/delete/{id}', 'CabangController@destroy');

//Konsumen
Route::get('/konsumens', 'KonsumenController@index');
Route::post('/konsumens/store', 'KonsumenController@store');
Route::get('/konsumens/{id}', 'KonsumenController@showbyID');
Route::patch('/konsumens/update/{id}', 'KonsumenController@update'); 
Route::delete('/konsumens/delete/{id}', 'KonsumenController@destroy');

//Jasa
Route::get('/jasas', 'JasaController@index');
Route::post('/jasas/store', 'JasaController@store');
Route::get('/jasas/{id}', 'JasaController@showbyID');
Route::patch('/jasas/update/{id}', 'JasaController@update'); 
Route::delete('/jasas/delete/{id}', 'JasaController@destroy');
