<?php

namespace App\Http\Controllers;

use App\Transaksi_Pengadaan;
use App\Transaksi_Penjualan;
use App\Detail_Jasa;
use App\Detail_Sparepart;
use App\Motor;
use App\Motor_Konsumen;
use App\Token;
use App\CompatibilityJason;
use App\Sparepart;
use App\Pegawai_On_Duty;
use App\Montir;
use App\Supplier;
use App\Detail_Pengadaan;
use PDF;

class LaporanController extends Controller
{
    //
    public function cetakSuratPemesanan($id)
    {
        $pengadaan  = Transaksi_Pengadaan::find($id);
        
        $pdf = PDF::loadview('cetak_pengadaan');
	    return $pdf->stream();
    }

    public function testSuratPemesanan($id)
    {
        $pengadaan  = Transaksi_Pengadaan::find($id);
        // dd($pengadaan);
        $supplier   = Supplier::find($pengadaan->Id_Supplier);
        $detail     = Detail_Pengadaan::where('Id_Pengadaan',$pengadaan->Id_Pengadaan);
        
        return view('cetak_pengadaan', compact('pengadaan', 'supplier', 'detail'));
    }
}
