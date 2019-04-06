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

//Role
Route::get('/roles', 'RoleController@index');
Route::post('/roles/store', 'RoleController@store');
Route::get('/roles/{id}', 'RoleController@showbyID');
Route::patch('/roles/update/{id}', 'RoleController@update'); 
Route::delete('/roles/delete/{id}', 'RoleController@destroy');

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

//Pegawai
Route::get('/pegawais', 'PegawaiController@index');
Route::post('/pegawais/store', 'PegawaiController@store');
Route::get('/pegawais/{id}', 'PegawaiController@showbyID');
Route::patch('/pegawais/update/{id}', 'PegawaiController@update'); 
Route::delete('/pegawais/delete/{id}', 'PegawaiController@destroy');
Route::POST('/pegawais/mobileauthenticate','PegawaiController@mobileauthenticate');

//Supplier
Route::get('/suppliers','SupplierController@index');
Route::post('/suppliers/store', 'SupplierController@store');
Route::get('/suppliers/{id}', 'SupplierController@showbyID');
Route::patch('/suppliers/update/{id}', 'SupplierController@update'); 
Route::delete('/suppliers/delete/{id}', 'SupplierController@destroy');

//Sparepart
Route::get('/spareparts','SparepartController@index');
Route::post('/spareparts/store', 'SparepartController@store');
Route::get('/spareparts/{id}', 'SparepartController@showbyID');
Route::patch('/spareparts/update/{id}', 'SparepartController@update'); 
Route::delete('/spareparts/delete/{id}', 'SparepartController@destroy');