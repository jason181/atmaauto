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
        $pengadaan = Transaksi_Pengadaan::find($id);
        $pengadaan->Status_Pengadaan = '1';
        $pengadaan->save();
        $datas  = DB::select("SELECT * FROM transaksi_pengadaans 
                    LEFT JOIN detail_pengadaans 
                    ON transaksi_pengadaans.Id_Pengadaan = detail_pengadaans.Id_Pengadaan 
                    LEFT JOIN suppliers
                    ON transaksi_pengadaans.Id_Supplier = suppliers.Id_Supplier
                    LEFT JOIN spareparts
                    ON detail_pengadaans.Kode_Sparepart = spareparts.Kode_Sparepart
                    WHERE transaksi_pengadaans.Id_Pengadaan = $id");
        $pdf = PDF::loadView('cetak_pengadaan',['datas' => $datas]);
        $pdf->setPaper([0,0,550,900]);
	    return $pdf->stream();
    }

    public function cetakSPK($id)
    {
        $penjualan = Transaksi_Penjualan::find($id);
        $penjualan->Status ='1';
        $penjualan->save();
        $spareparts = DB::select("SELECT t.Id_Transaksi as Id_Transaksi, 
        s.Kode_Sparepart as Kode, s.Nama_Sparepart as Nama, 
        s.Merk_Sparepart as Merk, s.Rak_Sparepart as Rak, 
        d.Jumlah as Jumlah
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN spareparts s ON s.Kode_Sparepart = d.Kode_Sparepart
        WHERE t.Id_Transaksi = $id");

        if(empty($spareparts))
        {
            $s_status = false;
        }
        else
        {
            $s_status = true;
        }

        $jasas = DB::select("SELECT t.Id_Transaksi as Id_Transaksi, 
        j2.Id_Jasa as KodeJasa, j2.Nama_Jasa as NamaJasa
        FROM transaksi_penjualans t 
        INNER JOIN detail_jasas j ON j.Id_Transaksi = t.Id_Transaksi
        INNER JOIN jasas j2 ON j2.Id_Jasa = j.Id_Jasa
        WHERE t.Id_Transaksi = $id");

        if(empty($jasas))
        {
            $j_status = false;
        }
        else
        {
            $j_status = true;
        }

        $header = DB::select("SELECT t.created_at as created_at, 
        t.Id_Transaksi as Id_Transaksi, k.Nama_Konsumen as Cust, 
        k.Telepon_Konsumen as Telepon
        FROM transaksi_penjualans t 
        INNER JOIN konsumens k ON k.Id_Konsumen = t.Id_Konsumen
        WHERE t.Id_Transaksi = $id");

        $cs = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as CS
        FROM transaksi_penjualans t 
        INNER JOIN pegawai_on_duties m ON m.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id");

        $montirsparepart = DB::select("SELECT t.Id_Transaksi, 
        p.Nama_Pegawai as Montir
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id");

        $montirjasa = DB::select("SELECT t.Id_Transaksi, 
        p.Nama_Pegawai as Montir
        FROM transaksi_penjualans t 
        INNER JOIN detail_jasas d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id");

        $motor = DB::select("SELECT t.Id_Transaksi, n.Merk as Merk, n.Tipe as Tipe, p.Plat_Kendaraan as Plat 
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN motor_konsumens p ON p.Id_Motor_Konsumen = m.Id_Motor_Konsumen
        INNER JOIN motors n ON n.Id_Motor = p.Id_Motor
        WHERE t.Id_Transaksi = $id");

        // dd($montirjasa,$montirsparepart);
        
        if($montirsparepart !== [] )
        {
            // dd($montirsparepart);
            $montir = $montirsparepart[0]->Montir;
        }
        else
        {
            // dd($montirjasa);
            $montir = $montirjasa[0]->Montir;
        }

        $kode = DB::select("SELECT t.Id_Transaksi, 
        CONCAT(t.Jenis_Transaksi,'-',t.created_at,'-',t.Id_Transaksi) 
        AS 'Kode_Transaksi'

        FROM transaksi_penjualans t 
        WHERE t.Id_Transaksi = $id");

        $pdf = PDF::loadView('cetak_spk',
        ['spareparts' => $spareparts,'jasas' => $jasas, 
        'header' => $header, 'cs' => $cs, 
        'montir' => $montir, 'kode' => $kode, 'motor' => $motor,
        's_status' => $s_status,'j_status'=>$j_status]);
        $pdf->setPaper([0,0,550,900]);
	    return $pdf->stream();
    }

    public function pendapatanBulanan()
    {
        $data = DB::select("SELECT MONTHNAME(STR_TO_DATE((m.bulan), '%m')) as Bulan, COALESCE(SUM(d.Subtotal_Detail_Sparepart),0) as Sparepart, COALESCE(SUM(e.Subtotal_Detail_Jasa),0) as Service,COALESCE((p.Total),0) as Total FROM (SELECT '01' AS
                            bulan
                            UNION SELECT '02' AS
                            bulan
                            UNION SELECT '03' AS
                            bulan
                            UNION SELECT '04' AS
                            bulan
                            UNION SELECT '05' AS
                            bulan
                            UNION SELECT '06' AS
                            bulan
                            UNION SELECT '07'AS
                            bulan
                            UNION SELECT '08'AS
                            bulan
                            UNION SELECT '09' AS
                            bulan
                            UNION SELECT '10' AS
                            bulan
                            UNION SELECT '11' AS
                            bulan
                            UNION SELECT '12' AS
                            bulan
                            ) AS m LEFT JOIN transaksi_penjualans p ON MONTHNAME(p.Tanggal_Transaksi) = MONTHNAME(STR_TO_DATE((m.bulan), '%m')) 
                            LEFT JOIN detail_spareparts d ON p.Id_Transaksi=d.Id_Transaksi
                            LEFT JOIN detail_jasas e ON p.Id_Transaksi=e.Id_Transaksi
                            where YEAR(p.Tanggal_Transaksi)='2019' or YEAR(P.Tanggal_Transaksi) is null
                            OR p.Status = '3' 
                            GROUP BY m.bulan, YEAR(p.Tanggal_Transaksi)");

        $total= DB::select("SELECT SUM(Total) as Total_Transaksi FROM transaksi_penjualans");
        // return $data;
        $pdf = PDF::loadView('pendapatan_bulanan',
        ['data'=>$data, 'total'=>$total]);
        $pdf->setPaper([0,0,550,900]);
	    return $pdf->stream();
    }

    public function pendapatanBulananDesktop()
    {
        $data = DB::select("SELECT MONTHNAME(STR_TO_DATE((m.bulan), '%m')) as Bulan, 
        COALESCE(SUM(d.Subtotal_Detail_Sparepart),0) as Sparepart, 
        COALESCE(SUM(e.Subtotal_Detail_Jasa),0) as Service,COALESCE((p.Total),0) as Total 
        FROM (SELECT '01' AS
                            bulan
                            UNION SELECT '02' AS
                            bulan
                            UNION SELECT '03' AS
                            bulan
                            UNION SELECT '04' AS
                            bulan
                            UNION SELECT '05' AS
                            bulan
                            UNION SELECT '06' AS
                            bulan
                            UNION SELECT '07'AS
                            bulan
                            UNION SELECT '08'AS
                            bulan
                            UNION SELECT '09' AS
                            bulan
                            UNION SELECT '10' AS
                            bulan
                            UNION SELECT '11' AS
                            bulan
                            UNION SELECT '12' AS
                            bulan
                            ) AS m LEFT JOIN transaksi_penjualans p ON MONTHNAME(p.Tanggal_Transaksi) = MONTHNAME(STR_TO_DATE((m.bulan), '%m')) 
                            LEFT JOIN detail_spareparts d ON p.Id_Transaksi=d.Id_Transaksi
                            LEFT JOIN detail_jasas e ON p.Id_Transaksi=e.Id_Transaksi
                            where YEAR(p.Tanggal_Transaksi)='2019' or YEAR(P.Tanggal_Transaksi) is null
                            OR p.Status = '3' 
                            GROUP BY m.bulan, YEAR(p.Tanggal_Transaksi)");

        return response()->json([
            'status' => (bool) $datas,
            'data' => $datas,
            'message' => $datas ? 'Success' : 'Error'
        ]);
    }

    public function testSuratPemesanan($id)
    {
        $pengadaan  = Transaksi_Pengadaan::find($id);
        // dd($pengadaan);
        $supplier   = Supplier::find($pengadaan->Id_Supplier);
        $detail     = Detail_Pengadaan::where('Id_Pengadaan',$pengadaan->Id_Pengadaan);
        
        return view('cetak_pengadaan', ['pengadaan' => $pengadaan, 'supplier' => $supplier, 'details' => $details]);
    }

    public function cetakSuratPemesananDesktop($id)
    {
        $datas  = DB::select("SELECT * FROM transaksi_pengadaans 
                    LEFT JOIN detail_pengadaans 
                    ON transaksi_pengadaans.Id_Pengadaan = detail_pengadaans.Id_Pengadaan 
                    LEFT JOIN suppliers
                    ON transaksi_pengadaans.Id_Supplier = suppliers.Id_Supplier
                    LEFT JOIN spareparts
                    ON detail_pengadaans.Kode_Sparepart = spareparts.Kode_Sparepart
                    WHERE transaksi_pengadaans.Id_Pengadaan = $id");

        return response()->json([
            'status' => (bool) $datas,
            'data' => $datas,
            'message' => $datas ? 'Success' : 'Error'
        ]);
    }

    public function cetakSuratPerintahKerjaDesktop($id)
    {
        $data1 = DB::select("SELECT t.Id_Transaksi as Id_Transaksi, s.Kode_Sparepart as Kode, s.Nama_Sparepart as Nama, s.Merk_Sparepart as Merk, s.Rak_Sparepart as Rak, d.Jumlah as Jumlah
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN spareparts s ON s.Kode_Sparepart = d.Kode_Sparepart
        WHERE t.Id_Transaksi = $id");

        $data2 = DB::select("SELECT t.Id_Transaksi as Id_Transaksi, j2.Id_Jasa as KodeJasa, j2.Nama_Jasa as NamaJasa
        FROM transaksi_penjualans t 
        INNER JOIN detail_jasas j ON j.Id_Transaksi = t.Id_Transaksi
        INNER JOIN jasas j2 ON j2.Id_Jasa = j.Id_Jasa
        WHERE t.Id_Transaksi = $id");

        $data3 = DB::select("SELECT t.created_at as created_at, t.Id_Transaksi as Id_Transaksi, k.Nama_Konsumen as Cust, k.Telepon_Konsumen as Telepon
        FROM transaksi_penjualans t 
        INNER JOIN konsumens k ON k.Id_Konsumen = t.Id_Konsumen
        WHERE t.Id_Transaksi = $id");

        $data4 = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as CS
        FROM transaksi_penjualans t 
        INNER JOIN pegawai_on_duties m ON m.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id");

        $data5 = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as Montir
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id");

        $data6 = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as Montir
        FROM transaksi_penjualans t 
        INNER JOIN detail_jasas d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id");

        $data7 = DB::select("SELECT t.Id_Transaksi, CONCAT(t.Jenis_Transaksi,'-',t.created_at,'-',t.Id_Transaksi) AS 'Kode Transaksi'
        FROM transaksi_penjualans t 
        WHERE t.Id_Transaksi = $id");

        $data8 = DB::select("SELECT t.Id_Transaksi, n.Merk as Merk, n.Tipe as Tipe, p.Plat_Kendaraan as Plat 
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN motor_konsumens p ON p.Id_Motor_Konsumen = m.Id_Motor_Konsumen
        INNER JOIN motors n ON n.Id_Motor = p.Id_Motor
        WHERE t.Id_Transaksi = $id");

       
        return response()->json([
            'status' => (bool) $data1,
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            'data6' => $data6,
            'data7' => $data7,
            'data8' => $data8,
            'message' => $data1 ? 'Success' : 'Error',
        ]);
    }

    public function cetakNotaLunas($id){
        $data1 = DB::select("SELECT t.Id_Transaksi as Id_Transaksi, s.Kode_Sparepart as Kode, s.Nama_Sparepart as Nama, s.Merk_Sparepart as Merk, s.Rak_Sparepart as Rak, d.Jumlah as Jumlah
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN spareparts s ON s.Kode_Sparepart = d.Kode_Sparepart
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        $data2 = DB::select("SELECT t.Id_Transaksi as Id_Transaksi, j2.Id_Jasa as KodeJasa, j2.Nama_Jasa as NamaJasa
        FROM transaksi_penjualans t 
        INNER JOIN detail_jasas j ON j.Id_Transaksi = t.Id_Transaksi
        INNER JOIN jasas j2 ON j2.Id_Jasa = j.Id_Jasa
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        $data3 = DB::select("SELECT t.created_at as created_at, t.Id_Transaksi as Id_Transaksi, k.Nama_Konsumen as Cust, k.Telepon_Konsumen as Telepon
        FROM transaksi_penjualans t 
        INNER JOIN konsumens k ON k.Id_Konsumen = t.Id_Konsumen
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        $data4 = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as CS
        FROM transaksi_penjualans t 
        INNER JOIN pegawai_on_duties m ON m.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        $data5 = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as Montir
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        $data6 = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as Montir
        FROM transaksi_penjualans t 
        INNER JOIN detail_jasas d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        $data7 = DB::select("SELECT t.Id_Transaksi, CONCAT(t.Jenis_Transaksi,'-',t.created_at,'-',t.Id_Transaksi) AS 'Kode Transaksi'
        FROM transaksi_penjualans t 
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        $data8 = DB::select("SELECT t.Id_Transaksi as Id_Transaksi, t.Subtotal as Subtotal, t.Diskon as Diskon, t.Total as Total
        FROM transaksi_penjualans t 
        WHERE t.Id_Transaksi = $id AND t.Status ='3'");

        $data9 = DB::select("SELECT t.Id_Transaksi, n.Merk as Merk, n.Tipe as Tipe, p.Plat_Kendaraan as Plat 
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN motor_konsumens p ON p.Id_Motor_Konsumen = m.Id_Motor_Konsumen
        INNER JOIN motors n ON n.Id_Motor = p.Id_Motor
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        return response()->json([
            'status' => (bool) $data1,
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            'data6' => $data6,
            'data7' => $data7,
            'data8' => $data8,
            'data9' => $data9,
            'message' => $data1 ? 'Success' : 'Error',
        ]);
    }

    public function cetaknotalunasWeb($id){
        $penjualan = Transaksi_Penjualan::find($id);
        $penjualan->Status = '3';
        $penjualan->save();


        $spareparts = DB::select("SELECT t.Id_Transaksi as Id_Transaksi, s.Kode_Sparepart as Kode, s.Nama_Sparepart as Nama, s.Merk_Sparepart as Merk, s.Rak_Sparepart as Rak, d.Jumlah as Jumlah, d.Harga_Satuan as Harga_Satuan, d.Subtotal_Detail_Sparepart as Subtotal_Detail_Sparepart
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN spareparts s ON s.Kode_Sparepart = d.Kode_Sparepart
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        $jasas = DB::select("SELECT t.Id_Transaksi as Id_Transaksi, j2.Id_Jasa as KodeJasa, j2.Nama_Jasa as NamaJasa
        FROM transaksi_penjualans t 
        INNER JOIN detail_jasas j ON j.Id_Transaksi = t.Id_Transaksi
        INNER JOIN jasas j2 ON j2.Id_Jasa = j.Id_Jasa
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        if($spareparts == [])
        {
            $s_status = false;
        }
        else
        {
            $s_status = true;
        }

        if($jasas == [])
        {
            $j_status = false;
        }
        else
        {
            $j_status = true;
        }
        $konsumens = DB::select("SELECT t.created_at as created_at, t.Id_Transaksi as Id_Transaksi, k.Nama_Konsumen as Cust, k.Telepon_Konsumen as Telepon
        FROM transaksi_penjualans t 
        INNER JOIN konsumens k ON k.Id_Konsumen = t.Id_Konsumen
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        $cs = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as CS
        FROM transaksi_penjualans t 
        INNER JOIN pegawai_on_duties m ON m.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id AND t.Status = '3' AND p.Id_Role = '2'");

        $kasir = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as Kasir
        FROM transaksi_penjualans t 
        INNER JOIN pegawai_on_duties m ON m.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id AND t.Status = '3' AND p.Id_Role = '3'");

        $montirsparepart= DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as Montir
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        $montirjasa = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as Montir
        FROM transaksi_penjualans t 
        INNER JOIN detail_jasas d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        if($montirsparepart !== [])
        {
            // dd($montirsparepart);
            $montir = $montirsparepart[0]->Montir;
        }
        else
        {
            // dd($montirjasa);
            $montir = $montirjasa[0]->Montir;
        }

        $kode = DB::select("SELECT t.Id_Transaksi, CONCAT(t.Jenis_Transaksi,'-',t.created_at,'-',t.Id_Transaksi) AS 'Kode_Transaksi'
        FROM transaksi_penjualans t 
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        $total = DB::select("SELECT t.Id_Transaksi as Id_Transaksi, t.Subtotal as Subtotal, t.Diskon as Diskon, t.Total as Total
        FROM transaksi_penjualans t 
        WHERE t.Id_Transaksi = $id AND t.Status ='3'");

        $motor = DB::select("SELECT t.Id_Transaksi, n.Merk as Merk, n.Tipe as Tipe, p.Plat_Kendaraan as Plat 
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN motor_konsumens p ON p.Id_Motor_Konsumen = m.Id_Motor_Konsumen
        INNER JOIN motors n ON n.Id_Motor = p.Id_Motor
        WHERE t.Id_Transaksi = $id AND t.Status = '3'");

        // return response()->json([
        //     'spareparts' => (bool) $spareparts,
        //     'spareparts' => $spareparts,
        //     'jasas' => $jasas,
        //     'konsumens' => $konsumens,
        //     'cs' => $cs,
        //     'montir' => $montir,
        //     'motor' => $motor,
        //     'total' => $total,
        //     'kode' => $kode,
        //     'message' => $spareparts ? 'Success' : 'Error',
        // ]);

        $pdf = PDF::loadView('cetak_nota_lunas',
        ['spareparts' => $spareparts,'jasas' => $jasas, 
        'konsumens'=>$konsumens, 'cs'=>$cs, 'kasir'=>$kasir,
        'montir' => $montir, 'kode' => $kode, 
        's_status'=>$s_status, 'j_status'=>$j_status,
        'motor' => $motor,'total'=>$total]);
        $pdf->setPaper([0,0,550,900]);
	    return $pdf->stream();
    }

    public function pendapatanTahunan()
    {
        $datas = DB::select("SELECT YEAR(c.Tanggal_Transaksi) AS Tahun, d.Nama_Cabang AS Cabang, SUM(c.Total) AS Total 
        FROM pegawai_on_duties a join pegawais b on b.Id_Pegawai=a.Id_Pegawai 
        JOIN transaksi_penjualans c on c.Id_Transaksi=a.Id_Transaksi
        join cabangs d on d.Id_Cabang=b.Id_Cabang
        WHERE b.Id_Role = 1 or b.Id_Role = 2
        GROUP BY YEAR(c.Tanggal_Transaksi),d.Nama_Cabang");

        return response()->json([
            'datas' => (bool) $datas,
            'datas' => $datas,
            'message' => $datas ? 'Success' : 'Error',
        ]);

        $pdf = PDF::loadView('pendapatan_tahunan',
        ['datas'=>$datas]);
        $pdf->setPaper([0,0,550,900]);
	    return $pdf->stream();
    }

    public function sparepartterlaris(){
        $datas = DB::select("SELECT MONTHNAME(STR_TO_DATE((m.bulan), '%m')) as Bulan, 
        Coalesce((select s.Nama_Sparepart 
                  from detail_spareparts t 
                  inner join spareparts s on t.Kode_Sparepart = s.Kode_Sparepart 
                  where MONTHNAME(t.created_at) = MONTHNAME(STR_TO_DATE((m.bulan), '%m')) 
                  group by t.Kode_Sparepart order by sum(t.Jumlah) DESC LIMIT 1),'-') AS NamaBarang, 
                  Coalesce((select s.Nama_Sparepart from detail_spareparts t 
                            inner join spareparts s on t.Kode_Sparepart = s.Kode_Sparepart 
                            where MONTHNAME(t.created_at) = MONTHNAME(STR_TO_DATE((m.bulan), '%m')) group by t.Kode_Sparepart 
                            order by sum(t.Jumlah) DESC LIMIT 1),'-') AS TipeBarang, 
                            Coalesce((select sum(Jumlah) 
                                      from detail_spareparts where MONTHNAME(created_at) = MONTHNAME(STR_TO_DATE((m.bulan), '%m')) 
                                      group by Kode_Sparepart 
                                      order by sum(Jumlah) DESC LIMIT 1),'-') AS JumlahPenjualan
                FROM(
                       SELECT '01' AS
                       bulan
                       UNION SELECT '02' AS
                       bulan
                       UNION SELECT '03' AS
                       bulan
                       UNION SELECT '04' AS
                       bulan
                       UNION SELECT '05' AS
                       bulan
                       UNION SELECT '06' AS
                       bulan
                       UNION SELECT '07'AS
                       bulan
                       UNION SELECT '08'AS
                       bulan
                       UNION SELECT '09' AS
                       bulan
                       UNION SELECT '10' AS
                       bulan
                       UNION SELECT '11' AS
                       bulan
                       UNION SELECT '12' AS
                       bulan
                ) AS m;");

        return response()->json([
                'datas' => (bool) $datas,
                'datas' => $datas,
                'message' => $datas ? 'Success' : 'Error',
            ]);
        $pdf = PDF::loadView('sparepart_terlaris',
        ['datas'=>$datas]);
        $pdf->setPaper([0,0,550,900]);
        return $pdf->stream();
    }

    public function penjualanjasa(){
        $datas = DB::select("SELECT
        p.Merk AS Merk,
        p.Tipe AS Tipe,
        s.Nama_Jasa AS `Nama Service`,
        Count( t.Tanggal_Transaksi ) AS `Jumlah Service`,
        YEAR(t.Tanggal_Transaksi) AS Tahun ,
        MONTHNAME(t.Tanggal_Transaksi) AS Bulan
    FROM
        motors AS p
        INNER JOIN motor_konsumens AS q ON q.Id_Motor = p.Id_Motor
           INNER JOIN transaksi_penjualans AS t ON t.Id_Konsumen = q.Id_Konsumen 
        INNER JOIN detail_jasas AS r ON r.Id_Transaksi = t.Id_Transaksi
        INNER JOIN jasas AS s ON s.Id_Jasa = r.Id_Jasa
    WHERE
        MONTHNAME( t.Tanggal_Transaksi ) = 'May' 
        AND YEAR ( t.Tanggal_Transaksi ) = 2019 
        AND t.Status = '3'
        AND t.Jenis_Transaksi = 'SV'
        OR t.Jenis_Transaksi = 'SS'
    GROUP BY
        p.Merk,
        p.Tipe,
        s.Nama_Jasa");

        return response()->json([
            'datas' => (bool) $datas,
            'datas' => $datas,
            'message' => $datas ? 'Success' : 'Error',
        ]);
        $pdf = PDF::loadView('penjualan_jasa',
        ['datas'=>$datas]);
        $pdf->setPaper([0,0,550,900]);
        return $pdf->stream();
    }

    public function pengeluaranbulanan(){
        $datas = DB::select("SELECT MONTHNAME(STR_TO_DATE((m.bulan), '%m')) as Bulan,
        COALESCE(SUM(p.Total_Harga),0) as 'Jumlah Pengeluaran'
        FROM (SELECT '01' AS
                bulan
                UNION SELECT '02' AS
                bulan
                UNION SELECT '03' AS
                bulan
                UNION SELECT '04' AS
                bulan
                UNION SELECT '05' AS
                bulan
                UNION SELECT '06' AS
                bulan
                UNION SELECT '07'AS
                bulan
                UNION SELECT '08'AS
                bulan
                UNION SELECT '09' AS
                bulan
                UNION SELECT '10' AS
                bulan
                UNION SELECT '11' AS
                bulan
                UNION SELECT '12' AS
                bulan
                ) AS m LEFT JOIN transaksi_pengadaans p ON MONTHNAME(p.Tanggal_Pengadaan) = MONTHNAME(STR_TO_DATE((m.bulan), '%m')) 
                WHERE p.Status_Pengadaan = '2' 
                OR YEAR(p.Tanggal_Pengadaan)='2019' 
                OR YEAR(P.Tanggal_Pengadaan) is null
                GROUP BY m.bulan, YEAR(p.Tanggal_Pengadaan)");
            
            return response()->json([
                'datas' => (bool) $datas,
                'datas' => $datas,
                'message' => $datas ? 'Success' : 'Error',
            ]);
            $pdf = PDF::loadView('penjualan_jasa',
            ['datas'=>$datas]);
            $pdf->setPaper([0,0,550,900]);
            return $pdf->stream();
        }
    }