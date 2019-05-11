<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transformers\DetailSparepartTransformers;
use App\Detail_Sparepart;
use App\Detail_Jasa;
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

    public function update(Request $request,$id) //cek lagi pake postman dan cek smua database
    {
        
        $sparepart = $request->Detail_Sparepart;
        
        $transaksi = Transaksi_Pengadaan::find($sparepart[0]['Id_Transaksi']);
        $sparepart = $request->Detail_Sparepart;
        $detail_sparepart = Detail_Sparepart::find($id);
        $Subtotal_Before = $detail_sparepart->Subtotal_Detail_Sparepart;
        $jumlah = $detail_sparepart->Jumlah - $sparepart[0]['Jumlah'];
        
        $sparepartdata = Sparepart::where('Kode_Sparepart',$sparepart[0]['Kode_Sparepart'])->get();
        $sparepartdata->Jumlah_Sparepart += $jumlah;
        $subtotal = $jumlah * $sparepart[0]['Harga_Satuan'];

        $detail_sparepart->update([
            'Jumlah'                    => $sparepart[0]['Jumlah'],
            'Subtotal_Detail_Sparepart' => $sparepart[0]['Subtotal_Detail_Sparepart']
        ]);
        
        $penjualan->Total += $subtotal;
        $penjualan->save();

        $response = $this->generateItem($detail_sparepart);
        return $this->sendResponse($response);
    }

    public function destroy($id)
    {
        $detail_sparepart = Detail_Sparepart::find($id);
        // dd($detail_sparepart);
        $sparepart  = Sparepart::where('Kode_Sparepart',$detail_sparepart->Kode_Sparepart);
        // dd($sparepart);
        $sparepart->Jumlah_Sparepart += $detail_sparepart->Jumlah;
        // dd($detail_sparepart->Id_Jasa_Montir);
        $montir = Montir::find($detail_sparepart->Id_Jasa_Montir);
        
        $status=$detail_sparepart->delete();
        
        $find_montir_sparepart  = Detail_Sparepart::where('Id_Jasa_Montir',$montir->Id_Jasa_Montir)->get();
        $find_montir_jasa       = Detail_Jasa::where('Id_Jasa_Montir',$montir->Id_Jasa_Montir)->get();
        if($find_montir_sparepart == null && $find_montir_jasa == null)
        {
            $status = $montir->delete();    
        }
        
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }

}
