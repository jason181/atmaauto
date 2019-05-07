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

class TransaksiPenjualanController extends RestController
{
    //
    protected $transformer = TransaksiPenjualanTransformers::Class;

    public function index()
    {
        $penjualan=Transaksi_Penjualan::get();
        $response=generateCollection($penjualan);
        return sendResponse($response);
    }

    public function store()
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
            $Pegawai=Token::orderBy('Id_Token', 'DESC')->first();
            // dd($Pegawai->Id_Pegawai);
            // $response = null;

            return $this->sendResponse($response, 201);
        }
        catch(\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
