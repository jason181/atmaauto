<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transformers\DetailSparepartTransformers;
use App\Detail_Sparepart;
use App\Transaksi_Penjualan;
use App\Montir;
use App\Sparepart;
use App\Transformers\TransaksiPenjualanTransformers;

class DetailSparepartController extends RestController
{
    protected $transformer=DetailSparepartTransformers::Class;

    public function index()
    {
        $detail_sparepart=Detail_Sparepart::get();
        $response=$this->generateCollection($detail_sparepart);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {

        $montir = Detail_Sparepart::where('Id_Transaksi',$request->Detail_Sparepart[0]['Id_Transaksi'])->first()->value('Id_Jasa_Montir');

        $penjualan  = new Transaksi_Penjualan;
        $detail_sparepart = new Detail_Sparepart;

        if($request->has('Detail_Sparepart'))
        {
            $sparepart      = $request->get('Detail_Sparepart');
            $countsparepart = count($sparepart);
            for($i=0;$i<$countsparepart;$i++)
            {
                $detail_sparepart->Id_Transaksi    = $sparepart[$i]['Id_Transaksi'];
                $detail_sparepart->Id_Jasa_Montir  = $montir;
                $detail_sparepart->Kode_Sparepart  = $sparepart[$i]['Kode_Sparepart'];
                $detail_sparepart->Harga_Satuan    = $sparepart[$i]['Harga_Satuan'];
                $detail_sparepart->Jumlah          = $sparepart[$i]['Jumlah'];
                $detail_sparepart->Subtotal_Detail_Sparepart = $sparepart[$i]['Subtotal_Detail_Sparepart'];
                $detail_sparepart->save();

                $sparepartCollection=Sparepart::where('Kode_Sparepart',$sparepart[$i]['Kode_Sparepart'])->get();
                $sparepartdata=$sparepartCollection->first();
                
                $sparepartdata->Jumlah_Sparepart -= $sparepart[$i]['Jumlah'];
                $sparepartdata->save();
            }

        }

        $penjualan = Transaksi_Penjualan::find($request->Detail_Sparepart[0]['Id_Transaksi']);
        $penjualan->Total += $request->Subtotal_Detail_Sparepart;
        $penjualan->save();

        $response = $this->generateItem($penjualan, new TransaksiPenjualanTransformers);
        return $this->sendResponse($response);
    }

    public function update(Request $request,$id)
    {
        $pengadaan = Transaksi_Pengadaan::find($request->Id_Transaksi);
        $before = $pengadaan->Jumlah; 
        $detail_sparepart = Detail_Sparepart::create([
            'Id_Transaksi'              => $request->Id_Transaksi,
            'Id_Jasa_Montir'            => $montir ->Id_Jasa_Montir,
            'Kode_Sparepart'            => $request->Kode_Sparepart,
            'Harga_Satuan'              => $request->Harga_Satuan,
            'Jumlah'                    => $request->Jumlah,
            'Subtotal_Detail_Sparepart' => $request->Subtotal_Detail_Sparepart
        ]);
        $transaksi = Transaksi_Pengadaan::find($request->Id_Transaksi);
        $transaksi->Total += $request->Subtotal_Detail_Sparepart;
        $transaksi->save();

        $response = $this->generateItem($detail_sparepart);
        return $this->sendResponse($response);
    }


}
