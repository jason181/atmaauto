<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;
// use App\Transformers\TransaksiPengadaanTransformers;
// use App\Transaksi_Pengadaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi_Pengadaan;
use App\Detail_Pengadaan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Transformers\TransaksiPengadaanTransformers;

class TransaksiPengadaanController extends RestController
{
    protected $transformer = TransaksiPengadaanTransformers::Class;
    public function index()
    {
        $pengadaan=Transaksi_Pengadaan::get();
        $response=$this->generateCollection($pengadaan);
        return $this->sendResponse($response,201);
    }
    public function store(Request $request)
    {
        try{
            date_default_timezone_set('Asia/Jakarta');
            $detail = $request->get('Detail_Pengadaan');
            $pengadaan = new Transaksi_Pengadaan;
            $pengadaan->Id_Supplier         = $request->get('Id_Supplier');
            $pengadaan->Tanggal_Pengadaan   = $request->get('Tanggal_Pengadaan').' '.date('H:i:s');
            $pengadaan->Total_Harga         = $request->get('Total_Harga');
            $pengadaan->Status_Pengadaan    = $request->get('Status_Pengadaan');
            
            $pengadaan->save();
            if($request->has('detail'))
            {
                $pengadaan = DB::transaction(function () use ($pengadaan,$detail) {
                    $pengadaan->detail_pengadaans()->createMany($detail);   
                    return $pengadaan;
                });
            }
            

            $response = $this->generateItem($pengadaan);
            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    public function storeDetail(Request $request){
        try{
            $detail = new Detail_Pengadaan;
            $detail->Id_Pengadaan         = $request->get('Id_Pengadaan');
            $detail->Kode_Sparepart         = $request->get('Kode_Sparepart');
            $detail->Harga_Satuan         = $request->get('Harga_Satuan');
            $detail->Jumlah         = $request->get('Jumlah');
            $detail->Subtotal_Pengadaan         = $request->get('Subtotal_Pengadaan');
        }catch(\Exception $e)
            {
                return $this->sendIseResponse($e->getMessage());
            }
    }
}