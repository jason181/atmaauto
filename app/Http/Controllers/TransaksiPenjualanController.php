<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

use App\Transaksi_Penjualan;
use App\Detail_Jasa;
use App\Detail_Sparepart;
use App\Motor;
use App\Motor_Konsumen;
use App\Token;
use App\CompatibilityJason;
use App\Sparepart;
use App\SparepartTransformers;
use App\Transformers\CompatibilityJasonTransformers;
use App\Transformers\TransaksiPenjualanTransformers;
use App\Transformers\MotorTransformers;
use App\Transformers\MotorKonsumenTransformers;

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

    public function showByIdMotorKonsumen($id)
    {
        $motorKonsumen = Motor_Konsumen::find($id);
        $motor = Motor::find($motorKonsumen->Id_Motor);
        $compatibility = CompatibilityJason::where('Id_Motor',$motor->Id_Motor)->value('Kode_Sparepart');
        // dd($compatibility);
        $sparepart  = Sparepart::find($compatibility);
        
        // dd($sparepart);
        $response=$this->generateCollection($sparepart);
        // dd($response);
        // return $this->sendResponse($response,201);
        return response()->json($sparepart,200);
    }

    public function store(Request $request)
    {
        try{
            date_default_timezone_set('Asia/Jakarta');
            $jasa       = $request->get('Detail_Jasa');
            $sparepart  = $request->get('Detail_Sparepart');
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
                $penjualan = DB::transaction(function () use($penjualan,$jasa){
                    $penjualan->detail_jasas()->createMany($jasa);
                    return $penjualan;  
                });
            }
            if($jenis == 'SS' || $jenis == 'SP')
            {
                $penjualan = DB::transaction(function () use($penjualan,$sparepart){
                    $penjualan->detail_spareparts()->createMany($sparepart);
                    return $penjualan;
                });
            }
            $response = $this->generateItem($penjualan);
            return $this->sendResponse($response, 201);
        }
        catch(\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
