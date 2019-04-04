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

Route::get('/', function () {return view('app');});
Route::get('/pegawai', function () {return view('app');});
Route::get('/jasa_service', function () {return view('app');});
Route::get('/supplier',function () {return view('app');});
Route::get('/sparepart',function () {return view('app');});