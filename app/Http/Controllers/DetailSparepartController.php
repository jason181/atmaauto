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
use App\Pegawai_On_Duty;
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

    public function detailsparepartkonsumen($id){
        $detailsparepart=Detail_Sparepart::where('Id_Transaksi',$id)->get();
        $response=$this->generateCollection($detailsparepart);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {
        // dd($request);
        $montirdata = Detail_Sparepart::where('Id_Transaksi',$request->Detail_Sparepart[0]['Id_Transaksi'])->first();
        if($montirdata !== null)
        {
            $montir=$montirdata->Id_Jasa_Montir;
        }
        else if($montirdata == null)
        {
            $montir = Detail_Jasa::where('Id_Transaksi',$request->Detail_Sparepart[0]['Id_Transaksi'])->first()->value('Id_Jasa_Montir');
        }
        
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
        if($penjualan->Jenis_Transaksi == 'SV')
        {
            $penjualan->Jenis_Transaksi = 'SS';
        }
        $penjualan->Subtotal += $sparepart[0]['Subtotal_Detail_Sparepart'];
        $penjualan->Total += $sparepart[0]['Subtotal_Detail_Sparepart'];
        $penjualan->save();

        $response = $this->generateItem($penjualan, new TransaksiPenjualanTransformers);
        return $this->sendResponse($response);
    }

    public function update(Request $request,$id) //cek lagi pake postman dan cek smua database
    {
        $sparepart = $request->Detail_Sparepart;
        
        $penjualan = Transaksi_Penjualan::find($sparepart[0]['Id_Transaksi']);
        $sparepart = $request->Detail_Sparepart;
        $detail_sparepart = Detail_Sparepart::find($id);

        $jumlah = $detail_sparepart->Jumlah - $sparepart[0]['Jumlah'];
        
        $sparepartdata = Sparepart::where('Kode_Sparepart',$sparepart[0]['Kode_Sparepart'])->get();
        $sparepartdata->Jumlah_Sparepart += $jumlah;
        $subtotal = $jumlah * $sparepart[0]['Harga_Satuan'];

        $detail_sparepart->update([
            'Jumlah'                    => $sparepart[0]['Jumlah'],
            'Subtotal_Detail_Sparepart' => $sparepart[0]['Subtotal_Detail_Sparepart']
        ]);
        
        $penjualan->Subtotal += $subtotal;
        $penjualan->Total += $subtotal;
        $penjualan->save();

        $response = $this->generateItem($detail_sparepart);
        return $this->sendResponse($response);
    }

    public function destroy($id)
    {
        $detail_sparepart = Detail_Sparepart::find($id);
        $id_transaksi = $detail_sparepart->Id_Transaksi;
        
        $sparepart  = Sparepart::where('Kode_Sparepart',$detail_sparepart->Kode_Sparepart)->first();
        $sparepart->Jumlah_Sparepart += $detail_sparepart->Jumlah;
        $sparepart->save();

        $montir = Montir::find($detail_sparepart->Id_Jasa_Montir);
        
        $penjualan = Transaksi_Penjualan::find($id_transaksi);
        $penjualan->Subtotal -= $detail_sparepart->Subtotal_Detail_Sparepart;
        $penjualan->Total -= $detail_sparepart->Subtotal_Detail_Sparepart;
        
        $status=$detail_sparepart->delete();
        
        $find_montir_sparepart  = Detail_Sparepart::where('Id_Jasa_Montir',$montir->Id_Jasa_Montir)->get();
        $find_montir_jasa       = Detail_Jasa::where('Id_Jasa_Montir',$montir->Id_Jasa_Montir)->get();
        // dd($find_montir_jasa,$find_montir_sparepart,$status);
        if($find_montir_sparepart->isEmpty() && $find_montir_jasa->isEmpty())
        {
            $status2 = $montir->delete();
            $pods = Pegawai_On_Duty::where('Id_Transaksi',$id_transaksi)->get();
            foreach($pods as $pod)
            {
                $delete_pod = $pod->delete();
            }
            $status3 = $penjualan->delete();
        }
        else if(!$find_montir_jasa->isEmpty() && $find_montir_sparepart->isEmpty())
        {
            $penjualan->Jenis_Transaksi = 'SV';
            $status3 = false;
            $status2 = false;
        }
        else
        {
            $status3 = false;
            $status2 = false;
        }
        $penjualan->save();
        
        return response()->json([
            'find_sparepart' => $find_montir_sparepart,
            'find_jasa' => $find_montir_jasa,
            'detail' => $status,
            'montir' => $status2,
            'penjualan' => $status3,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }

}
