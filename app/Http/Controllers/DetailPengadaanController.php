<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\DetailPengadaanTransformers;
use App\Detail_Pengadaan;
use App\Transaksi_Pengadaan;

class DetailPengadaanController extends RestController
{
    protected $transformer=DetailPengadaanTransformers::Class;

    public function index()
    {
        $detail_pengadaan=Detail_Pengadaan::get();
        $response=$this->generateCollection($detail_pengadaan);
        return $this->sendResponse($response,201);
    }

    public function showById($id)
    {
        $detail_pengadaan=Detail_Pengadaan::find($id);
        $response=$this->generateCollection($detail_pengadaan);
        return $this->sendResponse($response,201);
    }

    public function showByIdPengadaan($id)
    {
        $detail_pengadaan=Detail_Pengadaan::where('Id_Pengadaan',$id)->get();
        $response=$this->generateCollection($detail_pengadaan);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {
        $detail_pengadaan = Detail_Pengadaan::create([
            'Id_Pengadaan'      => $request->Id_Pengadaan,
            'Kode_Sparepart'    => $request->Kode_Sparepart,
            'Harga_Satuan'      => $request->Harga_Satuan,
            'Jumlah'            => $request->Jumlah,
            'Subtotal_Pengadaan'=> $request->Subtotal_Pengadaan
        ]);
        $pengadaan = Pengadaan::find($request->Id_Pengadaan);
        $pengadaan->Total_Harga += $request->Harga_Satuan * $request->Jumlah - $pengadaan->Total_Harga;
        $pengadaan->save();

        $response = $this->generateItem($detail_pengadaan);
        return $this->sendResponse($response);
    }

    public function update(Request $request,$id)
    {
        $detail_pengadaan = Detail_Pengadaan::find($id);
        $pengadaan = Transaksi_Pengadaan::find($detail_pengadaan->Id_Pengadaan);
        $pengadaan->Total_Harga += $detail_pengadaan->Harga_Satuan * $request->Jumlah - $detail_pengadaan->Subtotal_Pengadaan;
        $pengadaan->save();
        if(!is_null($request->Kode_Sparepart))
        {
            $detail_pengadaan->Kode_Sparepart = $request->Kode_Sparepart;
        }

        if(!is_null($request->Harga_Satuan))
        {
            $detail_pengadaan->Harga_Satuan = $request->Harga_Satuan;
        }

        if(!is_null($request->Jumlah))
        {
            $detail_pengadaan->Jumlah = $request->Jumlah;
        }

        if(!is_null($request->Subtotal_Pengadaan))
        {
            $detail_pengadaan->Subtotal_Pengadaan = $request->Harga_Satuan * $request->Jumlah;
        }
        else
        {
            $detail_pengadaan->Subtotal_Pengadaan = $detail_pengadaan->Harga_Satuan * $request->Jumlah;
        }
        $detail_pengadaan->save();
        $response = $this->generateItem($detail_pengadaan);
        return $this->sendResponse($response);
    }

    public function destroy($id)
    {
        $detail_pengadaan = Detail_Pengadaan::find($id);
        $pengadaan = Transaksi_Pengadaan::find($detail->Id_Pengadaan);
        $pengadaan->Total_Harga -= $detail_pengadaan->Subtotal_Pengadaan;
        $detail_pengadaan->delete();
        $cari_pengadaan = Detail_Pengadaan::where('Id_Pengadaan',$pengadaan->Id_Pengadaan)->get();
        if($cari_pengadaan == null)
        {
            $status = $pengadaan->delete();
        }
        $response = $this->generateItem($detail_pengadaan);
        return $this->sendResponse($detail_pengadaan);
    }
}
