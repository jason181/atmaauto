<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi_Penjualan;
use App\Detail_Jasa;
use App\Detail_Sparepart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Transformers\TransaksiPenjualanTransformers;
use App\Token;
use App\Sparepart;

class TransaksiPenjualanController extends RestController
{
    //
    protected $transformer = TransaksiPenjualanTransformers::Class;

    public function index()
    {
        $penjualan=Transaksi_Penjualan::get();
        $response= $this->generateCollection($penjualan);
        return $this->sendResponse($response);
    }

    public function store(Request $request)
    {
        try{
            date_default_timezone_set('Asia/Jakarta');
            $jasas      = $request->get('Detail_Jasa');
            $spareparts = $request->get('Detail_Sparepart');
            $jenis      = $request->get('Jenis_Transaksi');
            $penjualan  = new Transaksi_Penjualan;
            $penjualan->Id_Konsumen         = $request->get('Id_Konsumen');
            $penjualan->Tanggal_Transaksi   = $request->get('Tanggal_Transaksi');
            $penjualan->Jenis_Transaksi     = $request->get('Jenis_Transaksi');
            $penjualan->Subtotal            = $request->get('Subtotal');
            $penjualan->Diskon              = $request->get('Diskon');
            $penjualan->Total               = $request->get('Subtotal')-$request->get('Diskon');
            $penjualan->Status              = $request->get('Status');

            $penjualan->save();
            if($jenis == 'SS' || $jenis == 'SV')
            {
                $penjualan = DB::transaction(function () use($penjualan,$jasas){
                    $penjualan->detail_jasas()->createMany($jasas);
                    return $penjualan;  
                });
            }
            if($jenis == 'SS' || $jenis == 'SP')
            {
                $penjualan = DB::transaction(function () use($penjualan,$spareparts){
                    $penjualan->detail_spareparts()->createMany($spareparts);
                    return $penjualan;
                });
            }

            foreach($spareparts as $sparepart)
            {
                $data = Sparepart::find($sparepart['Kode_Sparepart']);
                $data->Jumlah_Sparepart = $data->Jumlah_Sparepart - $sparepart['Jumlah'];
                $data->save();
            }
            $response = $this->generateItem($penjualan);
            return $this->sendResponse($response, 201);
        }
        catch(\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $jasas=Detail_Jasa::where('Id_Transaksi',$id)->get();
        foreach($jasas as $jasa)
        {
            if(Detail_Jasa::where('Id_Transaksi',$id)->get() !== null)
            $delete = Detail_Jasa::where('Id_Transaksi',$id)->delete();
        }
        $spareparts=Detail_Spareart::where('Id_Transaksi',$id)->get();
        foreach($spareparts as $sparepart)
        {
            if(Detail_Sparepart::where('Id_Transaksi',$id)->get() !== null)
            $delete = Detail_Sparepart::where('Id_Transaksi',$id)->delete();
        }

        $penjualan=Transaksi_Penjualan::find($id);
        $status = $penjualan->delete();
        
        // $status = $supplier->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }
}
