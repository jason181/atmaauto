<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use App\Transaksi_Penjualan;
use App\Detail_Jasa;
use App\Detail_Sparepart;
use App\Motor;
use App\Motor_Konsumen;
use App\Token;
use App\CompatibilityJason;
use App\Sparepart;
use App\Pegawai_On_Duty;
use App\Montir;

use App\Transformers\MontirTransformers;
use App\Transformers\SparepartTransformers;
use App\Transformers\CompatibilityJasonTransformers;
use App\Transformers\TransaksiPenjualanTransformers;
use App\Transformers\MotorTransformers;
use App\Transformers\MotorKonsumenTransformers;
use App\Transformers\DetailSparepartTransfomers;

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

    public function transaksikeluar(){
        $penjualan=Transaksi_Penjualan::where('Status',3)->get();
        $response=$this->generateCollection($penjualan);
        return $this->sendResponse($response,201);
    }

    

    public function showByIdMotorKonsumen($id)
    {
        $motorKonsumen = Motor_Konsumen::find($id);
        $motor = Motor::find($motorKonsumen->Id_Motor);
        $compatibility = CompatibilityJason::where('Id_Motor',$motor->Id_Motor)->get();
        // $sparepart_ids = $compatibility
        //     ->map(function ($item) {
        //         return $item['Kode_Sparepart'];
        //     });

        $spareparts_found = $compatibility
            ->map(function ($item) {
                return Sparepart::find($item['Kode_Sparepart']);
            });
        // dd($spareparts_found);
        $response=$this->generateCollection($spareparts_found, new SparepartTransformers);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {
        try{
            date_default_timezone_set('Asia/Jakarta');

            $montir = Montir::create([
                'Id_Pegawai' => $request->Id_Montir,
                'Id_Motor_Konsumen' => $request->Id_Motor_Konsumen,
            ]);
            
            if($request->has('Detail_Jasa'))
            {
                $jasa       = $request->get('Detail_Jasa');
                $countjasa  = count($jasa);
                for($i=0; $i<$countjasa;$i++)
                {
                    $jasa[$i]['Id_Jasa_Montir'] = $montir->Id_Jasa_Montir;
                }
            }
            if($request->has('Detail_Sparepart'))
            {
                $sparepart      = $request->get('Detail_Sparepart');
                $countsparepart = count($sparepart);
                for($i=0;$i<$countsparepart;$i++)
                {
                    $sparepart[$i]['Id_Jasa_Montir']=$montir->Id_Jasa_Montir;
                }
            }
            
            $jenis      = $request->get('Jenis_Transaksi');
            $penjualan  = new Transaksi_Penjualan;
            $penjualan->Id_Konsumen         = $request->get('Id_Konsumen');
            $penjualan->Tanggal_Transaksi   = $request->get('Tanggal_Transaksi');
            $penjualan->Jenis_Transaksi     = $request->get('Jenis_Transaksi');
            $penjualan->Subtotal            = $request->get('Subtotal');
            $penjualan->Diskon              = $request->get('Diskon');
            $penjualan->Total               = $request->get('Subtotal')-$request->get('Diskon');

            $penjualan->Status = 0;
            $penjualan->save();
            
            if($jenis == 'SS' || $jenis == 'SV')
            {
                if($request->has('Detail_Jasa'))
                {
                    $penjualan = DB::transaction(function () use($penjualan,$jasa){
                        $penjualan->detail_jasas()->createMany($jasa);
                        return $penjualan;  
                    });
                }
            }
           // dd($penjualan);
            if($jenis == 'SS' || $jenis == 'SP')
            {
                if($request->has('Detail_Sparepart'))
                {
                    $penjualan = DB::transaction(function () use($penjualan,$sparepart){
                        $penjualan->detail_spareparts()->createMany($sparepart);
                        return $penjualan;
                    });
                }

                if($request->has('Detail_Sparepart'))
                {
                    for($i=0;$i<$countsparepart;$i++)
                    {
                        $sparepartCollection=Sparepart::where('Kode_Sparepart',$sparepart[$i]['Kode_Sparepart'])->get();
                        $sparepartdata=$sparepartCollection->first();
                        
                        $sparepartdata->Jumlah_Sparepart -= $sparepart[$i]['Jumlah'];
                        $sparepartdata->save();
                    }
                }
            }
            
            $pod[0]['Id_Pegawai'] = $request->get('Id_Pegawai');
            if($request->Id_Pegawai !== null)
            {
                $penjualan = DB::transaction(function () use($penjualan,$pod){
                    $penjualan->pegawai_on_duties()->createMany($pod);
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

    public function storeSparepart(Request $request)
    {
        try{
            $sparepart = new Detail_Sparepart;

            $montir = Montir::orderBy('Id_Jasa_Montir','DESC')->first();

            $sparepartCollection=Sparepart::where('Kode_Sparepart',$request->Kode_Sparepart)->get();
            $sparepartdata=$sparepartCollection->first();

            $sparepartdata->Jumlah_Sparepart += $request->Jumlah;
            $sparepartdata->save();

            $sparepart->Id_Transaksi        = $request->get('Id_Transaksi');
            $sparepart->Id_Jasa_Montir      = $montir->Id_Jasa_Montir;
            $sparepart->Kode_Sparepart      = $request->get('Kode_Sparepart');
            $sparepart->Harga_Satuan        = $request->get('Harga_Satuan');
            $sparepart->Jumlah              = $request->get('Jumlah');
            $sparepart->Subtotal_Detail_Sparepart = $request->get('Subtotal_Detail_Sparepart');
            $sparepart->save();

            return response()->json([
                'status' => (bool) $sparepart,
                'data' => $sparepart,
                'message' => $sparepart ? 'Success' : 'Error Role'
            ]);
        }catch(\Exception $e)
        {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function storeJasa(Request $request)
    {
        try{
            $jasa = new Detail_Jasa;

            $montir = Montir::orderBy('Id_Jasa_Montir','DESC')->first();
            // dd($montir);
            $jasa->Id_Transaksi        = $request->get('Id_Transaksi');
            $jasa->Id_Jasa_Montir      = $request->get('Id_Jasa_Montir');
            $jasa->Id_Jasa             = $request->get("Id_Jasa");
            $jasa->Id_Jasa             = $request->get("Subtotal_Detail_Jasa");
            $jasa->save();
            return response()->json([
                'status' => (bool) $jasa,
                'data' => $jasa,
                'message' => $jasa ? 'Success' : 'Error Role'
            ]);

        }catch(\Exception $e)
        {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function update(Request $request,$id)
    {
        try
        {
            $penjualan = Transaksi_Penjualan::find($id);
            $jenis=$request->Jenis_Transaksi;
            if($penjualan->Jenis_Transaksi == $jenis)
            {
                if($jenis == 'SS' || $jenis == 'SV')
                {
                    if($request->has('Detail_Jasa'))
                    {
                        $detail_jasas = Detail_Jasa::where('Id_Transaksi',$penjualan->Id_Transaksi)->get();
                        foreach($detail_jasas as $jasa)
                        {
                            $montir = Montir::where('Id_Jasa_Montir',$jasa->Id_Jasa_Montir)->first();
                            $delete_jasa = $jasa->delete();
                        }
                        $jasa       = $request->get('Detail_Jasa');
                        $countjasa  = count($jasa);
                        for($i=0; $i<$countjasa;$i++)
                        {
                            $jasa[$i]['Id_Jasa_Montir'] = $montir->Id_Jasa_Montir;
                        }
                        $penjualan = DB::transaction(function () use($penjualan,$jasa){
                            $penjualan->detail_jasas()->createMany($jasa);
                            return $penjualan;  
                        });
                    }
                }
                else if($jenis == 'SS' || $jenis == 'SP')
                {
                    if($request->has('Detail_Sparepart'))
                    {
                        $detail_spareparts = Detail_Sparepart::where('Id_Transaksi',$penjualan->Id_Transaksi)->get();
                        foreach($detail_spareparts as $sparepart)
                        {
                            $montir = Montir::where('Id_Jasa_Montir',$sparepart->Id_Jasa_Montir)->first();
                            $sparepartCollection = Sparepart::where('Kode_Sparepart',$sparepart->Kode_Sparepart)->get();
                            $sparepartdata = $sparepartCollection->first();
                            $sparepartdata->Jumlah_Sparepart += $sparepart->Jumlah;
                            $sparepartdata->save();
                            $delete_sparepart = $sparepart->delete();
                        }
                        $sparepart       = $request->get('Detail_Sparepart');
                        $countsparepart  = count($sparepart);
                        for($i=0; $i<$countsparepart;$i++)
                        {
                            $sparepart[$i]['Id_Jasa_Montir'] = $montir->Id_Jasa_Montir;
                        }
                        $penjualan = DB::transaction(function () use($penjualan,$sparepart){
                            $penjualan->detail_spareparts()->createMany($sparepart);
                            return $penjualan;  
                        });
                    }
                }

                if(!is_null($request->Tanggal_Transaksi))
                {
                    $penjualan->Tanggal_Transaksi   = $request->get('Tanggal_Transaksi');
                }
                if(!is_null($request->Jenis_Transaksi))
                {
                    $penjualan->Jenis_Transaksi     = $request->get('Jenis_Transaksi');
                }
                if(!is_null($request->Subtotal))
                {
                    $penjualan->Subtotal            = $request->get('Subtotal');
                }
                if(!is_null($request->Diskon))
                {
                    $penjualan->Diskon              = $request->get('Diskon');
                }
                if(!is_null($request->Total))
                {
                    $penjualan->Total               = $request->get('Total');
                }
                
                $penjualan->save();
                dd($penjualan);
                $response = $this->generateCollection($penjualan);
                return $this->sendResponse($response);
            }
        }
        catch(\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function updatetransaksimobile(Request $request,$id){
        try{
            $penjualan = Transaksi_Penjualan::find($id);
            if(!is_null($request->get("Tanggal_Transaksi")))
                {
                    $penjualan->Tanggal_Transaksi   = $request->get('Tanggal_Transaksi');
                }
                if(!is_null($request->get("Jenis_Transaksi")))
                {
                    $penjualan->Jenis_Transaksi     = $request->get('Jenis_Transaksi');
                }
                if(!is_null($request->get("Subtotal")))
                {
                    $penjualan->Subtotal            = $request->get('Subtotal');
                }
                if(!is_null($request->get("Diskon")))
                {
                    $penjualan->Diskon              = $request->get('Diskon');
                }
                if(!is_null($request->Total))
                {
                    $penjualan->Total               = $request->get('Total');
                }

                $penjualan->save();
                
                $response = $this->generateItem($penjualan);
                return $this->sendResponse($response,201);
        }catch(\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    
    public function destroy($id)
    {
        $jasas = Detail_Jasa::where('Id_Transaksi',$id)->get();
        foreach($jasas as $jasa)
        {
            // if(Detail_Jasa::where('Id_Transaksi',$id)->get() !== null)
            $montirs = Montir::where('Id_Jasa_Montir',$jasa->Id_Jasa_Montir)->get();
            
            $detele_jasa = $jasa->delete();

            foreach($montirs as $montir)
            {
                $delete_montir = $montir->delete();
            }
        }
        $spareparts = Detail_Sparepart::where('Id_Transaksi',$id)->get();
        foreach($spareparts as $sparepart)
        {
            $montirs = Montir::where('Id_Jasa_Montir',$sparepart->Id_Jasa_Montir)->get();
            
            $delete_sparepart = $sparepart->delete();

            foreach($montirs as $montir)
            {
                $delete_montir = $montir->delete();
            }
        }
        $pods = Pegawai_On_Duty::where('Id_Transaksi',$id)->get();
        foreach($pods as $pod)
        {
            $delete_pod = $pod->delete();
        }
        $penjualan = Transaksi_Penjualan::find($id);
        $status = $penjualan->delete();

        return response()->json([
            'status' =>$status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }

}
