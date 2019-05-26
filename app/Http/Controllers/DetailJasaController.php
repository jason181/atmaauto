<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\DetailJasaTransformers;
use App\Transformers\TransaksiPenjualanTransformers;
use App\Jasa;
use App\Detail_Jasa;
use App\Detail_Sparepart;
use App\Transaksi_Penjualan;
use App\Montir;

class DetailJasaController extends RestController
{
    protected $transformer=DetailJasaTransformers::Class;

    public function index()
    {
        $detail_jasa=Detail_Jasa::get();
        $response=$this->generateCollection($detail_jasa);
        return $this->sendResponse($response,201);
    }

    
    public function detailjasakonsumen($id){
        $detailjasa=Detail_Jasa::where('Id_Transaksi',$id)->get();
        $response=$this->generateCollection($detailjasa);
        return $this->sendResponse($response,201);
    }
    public function store(Request $request)
    {
        $montirdata = Detail_Jasa::where('Id_Transaksi',$request->Detail_Jasa[0]['Id_Transaksi'])->first();

        if($montirdata !== null)
        {
            $montir = $montirdata->Id_Jasa_Montir;
        }
        else if($montirdata == null)
        {
            $montir = Detail_Sparepart::where('Id_Transaksi',$request->Detail_Jasa[0]['Id_Transaksi'])->first()->value('Id_Jasa_Montir');
        }

        $detail_jasa = new Detail_Jasa;

        if($request->has('Detail_Jasa'))
        {
            $jasa      = $request->get('Detail_Jasa');
            $countjasa = count($jasa);
            for($i=0;$i<$countjasa;$i++)
            {
                $detail_jasa->Id_Transaksi      = $jasa[$i]['Id_Transaksi'];
                $detail_jasa->Id_Jasa_Montir    = $montir;
                $detail_jasa->Id_Jasa           = $jasa[$i]['Id_Jasa'];
                $detail_jasa->Subtotal_Detail_Jasa = $jasa[$i]['Subtotal_Detail_Jasa'];
                $detail_jasa->save();
            }
        }

        $penjualan = Transaksi_Penjualan::find($request->Detail_Jasa[0]['Id_Transaksi']);
        if($penjualan->Jenis_Transaksi == 'SP')
        {
            $penjualan->Jenis_Transaksi = 'SS';
        }
        $penjualan->Subtotal += $request->Subtotal_Detail_Jasa;
        $penjualan->Total += $request->Subtotal_Detail_Jasa;
        $penjualan->save();

        $response = $this->generateItem($penjualan, new TransaksiPenjualanTransformers);
        return $this->sendResponse($response);
    }

    public function update(Request $request,$id) //cek lagi pake postman dan cek smua database
    {
        $jasa = $request->Detail_Jasa;
        
        $penjualan = Transaksi_Penjualan::find($jasa[0]['Id_Transaksi']);
        $jasa = $request->Detail_Jasa;
        $detail_jasa = Detail_Jasa::find($id);
        
        $jasadata = Jasa::where('Id_Jasa',$jasa[0]['Id_Jasa'])->get();
        $subtotal = $jasa[0]['Subtotal_Detail_Jasa'] - $detail_jasa->Subtotal_Detail_Jasa;

        $detail_jasa->update([
            'Id_Jasa'               => $jasa[0]['Id_Jasa'],
            'Subtotal_Detail_Jasa'  => $jasa[0]['Subtotal_Detail_Jasa']
        ]);
        
        $penjualan->Subtotal +=$subtotal;
        $penjualan->Total += $subtotal;
        $penjualan->save();

        $response = $this->generateItem($detail_jasa);
        return $this->sendResponse($response);
    }

    public function destroy($id)
    {
        $detail_jasa = Detail_Jasa::find($id);
        $id_transaksi = $detail_jasa->Id_Transaksi;
        $jasa  = Jasa::where('Id_Jasa',$detail_jasa->Id_Jasa)->first();
        $montir = Montir::find($detail_jasa->Id_Jasa_Montir);
        $penjualan = Transaksi_Penjualan::find($id_transaksi);
        $penjualan->Subtotal -= $detail_jasa->Subtotal_Detail_Jasa;
        $penjualan->Total -+ $detail_jasa->Subtotal_Detail_Jasa;
        
        $status=$detail_jasa->delete();

        $find_montir_sparepart  = Detail_Sparepart::where('Id_Jasa_Montir',$montir->Id_Jasa_Montir)->get();
        $find_montir_jasa       = Detail_Jasa::where('Id_Jasa_Montir',$montir->Id_Jasa_Montir)->get();
        
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
        else if($find_montir_jasa->isEmpty() && !$find_montir_sparepart->isEmpty())
        {
            $penjualan->Jenis_Transaksi = 'SP';
            $status2=false;
            $status3=false;
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