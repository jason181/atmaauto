<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

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
        $datas  = DB::select("SELECT * FROM transaksi_pengadaans 
                    LEFT JOIN detail_pengadaans 
                    ON transaksi_pengadaans.Id_Pengadaan = detail_pengadaans.Id_Pengadaan 
                    LEFT JOIN suppliers
                    ON transaksi_pengadaans.Id_Supplier = suppliers.Id_Supplier
                    LEFT JOIN spareparts
                    ON detail_pengadaans.Kode_Sparepart = spareparts.Kode_Sparepart
                    WHERE transaksi_pengadaans.Id_Pengadaan = $id");
        // return $datas;
        $pdf = PDF::loadView('cetak_pengadaan',['datas' => $datas]);
        $pdf->setPaper([0,0,550,900]);
	    return $pdf->stream();
    }

    public function testSuratPemesanan($id)
    {
        $pengadaan  = Transaksi_Pengadaan::find($id);
        // dd($pengadaan);
        $supplier   = Supplier::find($pengadaan->Id_Supplier);
        $detail     = Detail_Pengadaan::where('Id_Pengadaan',$pengadaan->Id_Pengadaan);
        
        return view('cetak_pengadaan', ['pengadaan' => $pengadaan, 'supplier' => $supplier, 'details' => $details]);
    }
}
