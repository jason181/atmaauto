<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\DetailSparepartTransformers;
use App\Detail_Sparepart;
use App\Transaksi_Pengadaan;

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
        $montir = Montir::where('Id_Transaksi',$request->Id_Transaksi)->first();
        $detail_sparepart = Detail_Sparepart::create([
            'Id_Transaksi'              => $request->Id_Transaksi,
            'Id_Jasa_Montir'            => $monitr->Id_Jasa_Montir,
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
