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
Route::get('/pegawais/showMontir','PegawaiController@showMontir');
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
Route::get('/spareparts/showBelowMinimumStock','SparepartController@showBelowMinimumStock');
Route::get('/spareparts/sorthargaasc','SparepartController@sorthargaasc');
Route::get('/spareparts/sorthargadesc','SparepartController@sorthargadesc');
Route::get('/spareparts/sortjumlahasc','SparepartController@sortjumlahasc');
Route::get('/spareparts/sortjumlahdesc','SparepartController@sortjumlahdesc');
Route::get('/spareparts/sorthargaascjumlahasc','SparepartController@sorthargaascjumlahasc');
Route::get('/spareparts/sorthargaascjumlahdesc','SparepartController@sorthargaascjumlahdesc');
Route::get('/spareparts/sorthargadescjumlahasc','SparepartController@sorthargadescjumlahasc');
Route::get('/spareparts/sorthargadescjumlahdesc','SparepartController@sorthargadescjumlahdesc');
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

//Pengadaan
Route::get('/transaksi_pengadaans','TransaksiPengadaanController@index');
Route::post('/transaksi_pengadaans/store','TransaksiPengadaanController@store');
Route::get('/transaksi_pengadaans/transaksimasuk','TransaksiPengadaanController@transaksimasuk');
Route::post('/transaksi_pengadaans/storeDetail','TransaksiPengadaanController@storeDetail');
Route::patch('/transaksi_pengadaans/update/{id}', 'TransaksiPengadaanController@update');
Route::patch('/transaksi_pengadaans/updatemobile/{id}', 'TransaksiPengadaanController@updatemobile'); 
Route::delete('/transaksi_pengadaans/delete/{id}', 'TransaksiPengadaanController@destroy');
// Route::get('/transaksi_pengadaans/show/{id}', 'TransaksiPengadaanController@showbyCustomer');
Route::get('/transaksi_pengadaans/cetakSuratPemesanan/{id}','TransaksiPengadaanController@cetakSuratPemesanan');
Route::patch('/transaksi_pengadaans/verify/{id}','TransaksiPengadaanController@verify');


//Detail Pengadaan
Route::get('/detail_pengadaans','DetailPengadaanController@index');
Route::get('/detail_pengadaans/showById/{id}','DetailPengadaanController@showById');
Route::get('/detail_pengadaans/showByIdPengadaan/{id}','DetailPengadaanController@showByIdPengadaan');
Route::post('/detail_pengadaans','DetailPengadaanController@store');
Route::patch('/detail_pengadaans/update/{id}', 'DetailPengadaanController@update'); 
Route::delete('/detail_pengadaans/delete/{id}', 'DetailPengadaanController@destroy');

//Penjualan
Route::get('/transaksi_penjualans','TransaksiPenjualanController@index');
// Route::group(['middleware' => 'token'], function () {
    Route::get('/transaksi_penjualans/showByIdMotorKonsumen/{id}','TransaksiPenjualanController@showByIdMotorKonsumen');
    Route::get('/transaksi_penjualans/transaksikeluar','TransaksiPenjualanController@transaksikeluar');
    Route::get('/transaksi_penjualans/processed','TransaksiPenjualanController@processed');
    Route::get('/transaksi_penjualans/finished','TransaksiPenjualanController@finished');
    Route::post('/transaksi_penjualans/store','TransaksiPenjualanController@store');
    Route::post('/transaksi_penjualans/storeSparepart','TransaksiPenjualanController@storeSparepart');
    Route::post('/transaksi_penjualans/storeJasa','TransaksiPenjualanController@storeJasa');
    Route::patch('/transaksi_penjualans/update/{id}','TransaksiPenjualanController@update');
    Route::delete('/transaksi_penjualans/delete/{id}','TransaksiPenjualanController@destroy');
    
// });

//Detail Sparepart Transaksi Penjualan
Route::get('/detail_spareparts','DetailSparepartController@index');
Route::post('/detail_spareparts/store','DetailSparepartController@store');
Route::patch('/detail_spareparts/update/{id}','DetailSparepartController@update');
Route::delete('/detail_spareparts/delete/{id}','DetailSparepartController@destroy');

//Detail Jasa Transaksi Penjualan
Route::get('/detail_jasas','DetailJasaController@index');
Route::post('/detail_jasas/store','DetailJasaController@store');
Route::patch('/detail_jasas/update/{id}','DetailJasaController@update');
Route::delete('/detail_jasas/delete/{id}','DetailJasaController@destroy');


//Laporan
Route::get('/cetak_surat_pemesanan/{id}', 'LaporanController@cetakSuratPemesanan');
Route::get('/cetak_spk/{id}', 'LaporanController@cetakSPK');
Route::get('/test-surat-pemesanan/{id}', 'LaporanController@cetakSuratPemesanan');

Route::get('/cetakNotaLunas/{id}','LaporanController@cetakNotaLunas');
Route::get('/cetakSuratPemesananDesktop/{id}','LaporanController@cetakSuratPemesananDesktop');
Route::get('/cetakSuratPerintahKerjaDesktop/{id}','LaporanController@cetakSuratPerintahKerjaDesktop');

//History
Route::get('/history_masuk','TransaksiPengadaanController@historymasuk');
Route::get('/history_keluar','TransaksiPenjualanController@historykeluar');