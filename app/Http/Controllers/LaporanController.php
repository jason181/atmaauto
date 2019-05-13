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
        // return $id;
        $pengadaan  = Transaksi_Pengadaan::find($id);
        // return $pengadaan;
        // dd($pengadaan);
        $supplier   = Supplier::find($pengadaan->Id_Supplier);
        // return 
        $detail     = Detail_Pengadaan::where('Id_Pengadaan',$pengadaan->Id_Pengadaan)->get();
        // return $detail;
        // return $id;.
        $pdf = PDF::loadView('cetak_pengadaan',['pengadaan' => $pengadaan, 'supplier' => $supplier, 'detail' => $detail]);
        $pdf->setPaper([0,0,550,900]);
	    return $pdf->stream();
    }

    public function testSuratPemesanan($id)
    {
        $pengadaan  = Transaksi_Pengadaan::find($id);
        // dd($pengadaan);
        $supplier   = Supplier::find($pengadaan->Id_Supplier);
        $detail     = Detail_Pengadaan::where('Id_Pengadaan',$pengadaan->Id_Pengadaan);
        
        return view('cetak_pengadaan', ['pengadaan' => $pengadaan, 'supplier' => $supplier, 'detail' => $detail]);
    }
}
