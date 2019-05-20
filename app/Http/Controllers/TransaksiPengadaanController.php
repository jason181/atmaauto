<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi_Pengadaan;
use App\Detail_Pengadaan;
use App\Supplier;
use App\Sparepart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Transformers\TransaksiPengadaanTransformers;
use App\Transformers\SparepartTransformers;
use PDF;

class TransaksiPengadaanController extends RestController
{
    protected $transformer = TransaksiPengadaanTransformers::Class;
    
    public function index()
    {
        $pengadaan=Transaksi_Pengadaan::orderBy('Id_Pengadaan','DESC')->get();
        $response=$this->generateCollection($pengadaan);
        return $this->sendResponse($response,201);
    }

    public function historymasuk()
    {
        $masuk = DB::select("SELECT * FROM transaksi_pengadaans 
        LEFT JOIN detail_pengadaans ON transaksi_pengadaans.Id_Pengadaan = detail_pengadaans.Id_Pengadaan
        LEFT JOIN spareparts ON detail_pengadaans.Kode_Sparepart = spareparts.Kode_Sparepart
        WHERE transaksi_pengadaans.Status_Pengadaan = 2 ORDER BY transaksi_pengadaans.Tanggal_Pengadaan DESC");
        
        return response()->json([
            'status' => (bool) $masuk,
            'data' => $masuk,
            'message' => $masuk ? 'Success' : 'Error History Masuk'
        ]);

        // $response=$this->generateCollection($masuk);
        // return $this->sendResponse($response,201);
    }

    public function transaksimasuk(){
        $pengadaan=Transaksi_Pengadaan::where('Status_Pengadaan',2)->get();
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

            $detail->save();
            $response = $this->generateItem($detail);
            return $this->sendResponse($response);
        }catch(\Exception $e)
        {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    
    public function update(Request $request,$id)
    {
        // return $request;
        date_default_timezone_set('Asia/Jakarta');
        $details = Detail_Pengadaan::where('Id_Pengadaan',$id)->get();
        
        foreach($details as $detail)
        {
            if(Detail_Pengadaan::where('Id_Pengadaan',$id)->get() !== null)
                $delete = Detail_Pengadaan::where('Id_Pengadaan',$id)->delete();
        }

        $pengadaan = Transaksi_Pengadaan::find($id);
        if($request->has('Detail_Pengadaan'))
        {
            $detail=$request->Detail_Pengadaan;
        }

        if(!is_null($request->get('Id_Supplier'))){
            $pengadaan->Id_Supplier         = $request->get('Id_Supplier');
        }
        if(!is_null($request->get('Tanggal_Pengadaan'))){
            $pengadaan->Tanggal_Pengadaan   = $request->get('Tanggal_Pengadaan').' '.date('H:i:s');
        }
        if(!is_null($request->get('Total_Harga'))){
            $pengadaan->Total_Harga         = $request->get('Total_Harga');
        }
        
        if($request->has('Detail_Pengadaan'))
        {
            $pengadaan = DB::transaction(function () use ($pengadaan,$detail) {
                $pengadaan->detail_pengadaans()->createMany($detail);   
                return $pengadaan;
            });
        }
        $pengadaan->save();

        $response=$this->generateItem($pengadaan);
        return $this->sendResponse($response);
    }

    public function updatemobile(Request $request,$id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $pengadaan = Transaksi_Pengadaan::find($id);

        if(!is_null($request->get('Tanggal_Pengadaan'))){
            $pengadaan->Tanggal_Pengadaan   = $request->get('Tanggal_Pengadaan').' '.date('H:i:s');
        }
        if(!is_null($request->get('Total_Harga'))){
            $pengadaan->Total_Harga         = $request->get('Total_Harga');
        }
        
        $pengadaan->save();

        $response=$this->generateItem($pengadaan);
        return $this->sendResponse($response,201);
    }

    public function verify($id)
    {
        $pengadaan = Transaksi_Pengadaan::find($id);

        $pengadaan->Status_Pengadaan = '2';
        $details = Detail_Pengadaan::where('Id_Pengadaan',$id)->get();
        
        $count_detail = count($details);
        for($i=0;$i<$count_detail;$i++)
        {
            $sparepart=Sparepart::where('Kode_Sparepart',$details[$i]->Kode_Sparepart)->first();
            $sparepart->Jumlah_Sparepart += $details[$i]->Jumlah;
            $sparepart->save();
        }
        $pengadaan->save();
        $response = $this->generateItem($pengadaan);
        return $this->sendResponse($response,201);
    }

    public function destroy($id)
    {
        $details=Detail_Pengadaan::where('Id_Pengadaan',$id)->get();
        foreach($details as $detail)
        {
            if(Detail_Pengadaan::where('Id_Pengadaan',$id)->get() !== null)
            $delete = Detail_Pengadaan::where('Id_Pengadaan',$id)->delete();
        }

        $pengadaan=Transaksi_Pengadaan::find($id);
        $status = $pengadaan->delete();
        
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }
}