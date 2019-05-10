<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transformers\DetailSparepartTransformers;
use App\Detail_Sparepart;
use App\Transaksi_Penjualan;
use App\Montir;

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
        // dd($request->Detail_Sparepart[0]['Id_Transaksi']);
        $detail_sparepart = Detail_Sparepart::where('Id_Transaksi',$request->Detail_Sparepart[0]['Id_Transaksi'])->first();
        // $detail = $request->Detail_Sparepart;
        // dd($detail_sparepart->Id_Jasa_Montir);
        $penjualan  = new Transaksi_Penjualan;
        // if($request->has('Detail_Sparepart'))
        // {
        //     $sparepart      = $request->get('Detail_Sparepart');
        //     $countsparepart = count($sparepart);
        //     for($i=0;$i<$countsparepart;$i++)
        //     {
        //         $sparepart[$i]['Id_Jasa_Montir']=$montir->Id_Jasa_Montir;
        //     }
        // }
        if($request->has('Detail_Sparepart'))
        {
            $sparepart      = $request->get('Detail_Sparepart');
            $countsparepart = count($sparepart);
            for($i=0;$i<$countsparepart;$i++)
            {
                $sparepart[$i]['Id_Jasa_Montir']=$detail_sparepart->Id_Jasa_Montir;
                
            }
            // dd($sparepart[0]['Id_Jasa_Montir']);
            $penjualan = DB::transaction(function () use ($penjualan,$sparepart){
                $penjualan->detail_spareparts()->createMany($sparepart);
                return $penjualan;
            });

        }

        // $detail_sparepart = Detail_Sparepart::create([
        //     'Id_Transaksi'              => $request->Id_Transaksi,
        //     'Id_Jasa_Montir'            => $montir->Id_Jasa_Montir,
        //     'Kode_Sparepart'            => $request->Kode_Sparepart,
        //     'Harga_Satuan'              => $request->Harga_Satuan,
        //     'Jumlah'                    => $request->Jumlah,
        //     'Subtotal_Detail_Sparepart' => $request->Subtotal_Detail_Sparepart
        // ]);
        $penjualan = Transaksi_Pengadaan::find($request->Id_Transaksi);
        $penjualan->Total += $request->Subtotal_Detail_Sparepart;
        $penjualan->save();

        $response = $this->generateItem($detail_sparepart);
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
