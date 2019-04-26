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

//Sales
Route::patch('/suppliers/upSales/{id}','SupplierController@upSales');
Route::patch('/suppliers/delSales/{id}', 'SupplierController@delSales');

//Sparepart
Route::get('/spareparts','SparepartController@index');
Route::post('/spareparts/store', 'SparepartController@store');
Route::post('/spareparts/storemobile', 'SparepartController@storemobile');
Route::post('/spareparts/updatepicmobile', 'SparepartController@updatepicmobile');
Route::get('/spareparts/{id}', 'SparepartController@showbyID');
Route::patch('/spareparts/update/{id}', 'SparepartController@update');
Route::patch('/spareparts/updatemobile/{id}', 'SparepartController@updatemobile'); 
Route::delete('/spareparts/delete/{id}', 'SparepartController@destroy');

//Token
Route::post('/authenticate', 'TokenController@authenticate');
Route::post('/mobileauthenticate', 'TokenController@mobileauthenticate');
Route::get('/session', 'TokenController@validateToken');

//Motor
Route::get('/motors','MotorController@index');
Route::post('/motors/store', 'MotorController@store');
Route::patch('/motors/update/{id}', 'MotorController@update'); 
Route::delete('/motors/delete/{id}', 'MotorController@destroy');

//Motor Konsumen
Route::get('/motor_konsumens','MotorKonsumenController@index');
Route::post('/motor_konsumens/store', 'MotorKonsumenController@store');
Route::patch('/motor_konsumens/update/{id}', 'MotorKonsumenController@update'); 
Route::delete('/motor_konsumens/delete/{id}', 'MotorKonsumenController@destroy');
Route::get('/motor_konsumens/show/{id}', 'MotorKonsumenController@showbyCustomer');

//Transaksi Pengadaan
Route::get('/transaksi_pengadaans','TransaksiPengadaanController@index');
Route::post('/transaksi_pengadaans/store', 'TransaksiPengadaanController@store');
Route::patch('/transaksi_pengadaans/update/{id}', 'TransaksiPengadaanController@update'); 
Route::delete('/transaksi_pengadaans/delete/{id}', 'TransaksiPengadaanController@destroy');