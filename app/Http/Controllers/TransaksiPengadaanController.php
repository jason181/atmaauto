<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi_Pengadaan;
use App\Detail_Pengadaan;
use App\Supplier;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Transformers\TransaksiPengadaanTransformers;
use PDF;
// use Barryvdh\DomPDF\Facade as PDF;

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
            if($request->has('Detail_Pengadaan'))
            {
                $detail = $request->get('Detail_Pengadaan');
            }
            $pengadaan = new Transaksi_Pengadaan;
            $pengadaan->Id_Supplier         = $request->get('Id_Supplier');
            $pengadaan->Tanggal_Pengadaan   = $request->get('Tanggal_Pengadaan').' '.date('H:i:s');
            $pengadaan->Total_Harga         = $request->get('Total_Harga');
            $pengadaan->Status_Pengadaan    = $request->get('Status_Pengadaan');
            
            $pengadaan->save();

            if($request->has('Detail_Pengadaan'))
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
            $detail->Id_Pengadaan       = $request->get('Id_Pengadaan');
            $detail->Kode_Sparepart     = $request->get('Kode_Sparepart');
            $detail->Harga_Satuan       = $request->get('Harga_Satuan');
            $detail->Jumlah             = $request->get('Jumlah');
            $detail->Subtotal_Pengadaan = $request->get('Subtotal_Pengadaan');
        }catch(\Exception $e)
        {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    
    public function update($id)
    {
        $pengadaan = Transaksi_Pengadaan::find($id);

        if(!is_null($request->get('Id_Supplier'))){
            $pengadaan->Id_Supplier         = $request->get('Id_Supplier');
        }
        if(!is_null($request->get('Tanggal_Pengadaan'))){
            $pengadaan->Tanggal_Pengadaan   = $request->get('Tanggal_Pengadaan').' '.date('H:i:s');
        }
        // if(!is_null($request->Telepon_Pegawai)){
        //     $pengadaan->Total_Harga         = $request->get('Total_Harga');
        // }
        if(!is_null($request->get('Status_Pengadaan'))){
            $pengadaan->Status_Pengadaan    = $request->get('Status_Pengadaan');
        }
        
        $success = $pengadaan->save();

        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }

    public function destroy($id)
    {
        $details=Detail_Pengadaan::where('Id_Pengadaan',$id)->get();
        foreach($details as $detail)
        {
            if(Detail_Pengadaan::where('Id_Pengadaan',$id)->get() !== null)
            $delete = Detail_Pengadaan::where('Id_Pengadaan',$id)->delete();
        }
        // dd($detail = Detail_Pengadaan::where('Id_Pengadaan',$id)->get());
        $pengadaan=Transaksi_Pengadaan::find($id);
        $status = $pengadaan->delete();
        
        // $status = $supplier->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }

    public function cetakSuratPemesanan($id)
    {
        $pengadaan  = Transaksi_Pengadaan::find($id);
        $supplier   = Supplier::find($pengadaan->Id_Supplier);
        $detail     = Detail_Pengadaan::where('Id_Pengadaan',$pengadaan->Id_Pengadaan);
        // dd($pengadaan);
        // dd($supplier);
        // dd($detail);
        $pdf = PDF::loadview('cetak_pengadaan',['pengadaan' => $pengadaan,'supplier' => $supplier, 'detail' => $detail]);
	    return $pdf->stream();
    }

    
}