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
use App\Konsumen;

use App\Transformers\MontirTransformers;
use App\Transformers\SparepartTransformers;
use App\Transformers\CompatibilityJasonTransformers;
use App\Transformers\TransaksiPenjualanTransformers;
use App\Transformers\MotorTransformers;
use App\Transformers\MotorKonsumenTransformers;
use App\Transformers\DetailSparepartTransfomers;
use App\Transformers\KonsumenTransformers;

class TransaksiPenjualanController extends RestController
{
    //
    protected $transformer = TransaksiPenjualanTransformers::Class;

    public function index()
    {
        $penjualan=Transaksi_Penjualan::orderBy('Id_Transaksi','DESC')->get();
        $response= $this->generateCollection($penjualan);
        return $this->sendResponse($response);
    }

    public function cekStatus($hp,$plat)
    {
        $konsumen = Konsumen::where('Telepon_Konsumen',$hp)->first();
        $penjualans = Transaksi_Penjualan::where('Id_Konsumen',$konsumen->Id_Konsumen)->get();
        $arr_penjualan = [];

        $arr_filtered = [];
        $unique_arr_filtered = [];
        foreach($penjualans as $penjualan)
        {
            array_push($arr_penjualan,$penjualan->Id_Transaksi);
        }

        foreach($penjualans as $penjualan)
        { 
            if($penjualan->Jenis_Transaksi == 'SS' || $penjualan->Jenis_Transaksi == 'SV')
            {
                $detail_jasas = Detail_Jasa::where('Id_Transaksi',$penjualan->Id_Transaksi)->get();
                foreach($detail_jasas as $detail_jasa)
                {
                    if($detail_jasa->montirs->motor_konsumens->Plat_Kendaraan == $plat)
                    {
                        array_push($arr_filtered,$detail_jasa->Id_Transaksi);
                    }
                }
            }
            if($penjualan->Jenis_Transaksi == 'SS' || $penjualan->Jenis_Transaksi == 'SP')
            {
                $detail_spareparts = Detail_Sparepart::where('Id_Transaksi',$penjualan->Id_Transaksi)->get();
                foreach($detail_spareparts as $detail_sparepart)
                {
                    array_push($arr_filtered,$detail_sparepart->Id_Transaksi);
                }
            }
        }

        $result=Transaksi_Penjualan::whereIn('Id_Transaksi',$arr_filtered)->orderBy('Id_Transaksi','DESC')->get();

        $response = $this->generateCollection($result);
        return $this->sendResponse($response);
    }

    public function processed()
    {
        $processed = Transaksi_Penjualan::where('Status','1')->get();
        $response = $this->generateCollection($processed);
        return $this->sendResponse($response);
    }

    public function finished()
    {
        $finished = Transaksi_Penjualan::where('Status','2')->get();
        $response = $this->generateCollection($finished);
        return $this->sendResponse($response);
    }

    public function historykeluar()
    {
        $keluar = DB::select("SELECT * FROM transaksi_penjualans 
        LEFT JOIN detail_spareparts ON transaksi_penjualans.Id_Transaksi = detail_spareparts.Id_Transaksi
        LEFT JOIN spareparts ON detail_spareparts.Kode_Sparepart = spareparts.Kode_Sparepart
        WHERE spareparts.Kode_Sparepart IS NOT NULL ORDER BY transaksi_penjualans.Tanggal_Transaksi DESC");
        
        return response()->json([
            'status' => (bool) $keluar,
            'data' => $keluar,
            'message' => $keluar ? 'Success' : 'Error History Keluar'
        ]);

    }

    public function transaksikeluar(){
        $penjualan=Transaksi_Penjualan::where('Status',3)->get();
        $response=$this->generateCollection($penjualan);
        return $this->sendResponse($response,201);
    }

    public function transaksiunprocess(){
        $penjualan=Transaksi_Penjualan::where('Status',0)->get();
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

            $sparepartdata->Jumlah_Sparepart -= $request->Jumlah;
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
            $jasa->Id_Transaksi        = $request->get('Id_Transaksi');
            $jasa->Id_Jasa_Montir      = $montir->Id_Jasa_Montir;
            $jasa->Id_Jasa             = $request->get("Id_Jasa");
            $jasa->Subtotal_Detail_Jasa             = $request->get("Subtotal_Detail_Jasa");
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
            $detail_jasas = Detail_Jasa::where('Id_Transaksi',$penjualan->Id_Transaksi)->get();
            foreach($detail_jasas as $jasa)
            {
                $montir = Montir::where('Id_Jasa_Montir',$jasa->Id_Jasa_Montir)->first();
                $delete_jasa = $jasa->delete();
            }
            // if($penjualan->Jenis_Transaksi == $jenis)
            // {
                if($jenis == 'SS' || $jenis == 'SV')
                {
                    if($request->has('Detail_Jasa'))
                    {
                        // $detail_jasas = Detail_Jasa::where('Id_Transaksi',$penjualan->Id_Transaksi)->get();
                        // foreach($detail_jasas as $jasa)
                        // {
                        //     $montir = Montir::where('Id_Jasa_Montir',$jasa->Id_Jasa_Montir)->first();
                        //     $delete_jasa = $jasa->delete();
                        // }
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
                if($jenis == 'SS' || $jenis == 'SP')
                {
                    if($request->has('Detail_Sparepart'))
                    {
                        // $detail_spareparts = Detail_Sparepart::where('Id_Transaksi',$penjualan->Id_Transaksi)->get();
                        // foreach($detail_spareparts as $sparepart)
                        // {
                        //     $montir = Montir::where('Id_Jasa_Montir',$sparepart->Id_Jasa_Montir)->first();
                        //     $sparepartCollection = Sparepart::where('Kode_Sparepart',$sparepart->Kode_Sparepart)->get();
                        //     $sparepartdata = $sparepartCollection->first();
                        //     $sparepartdata->Jumlah_Sparepart += $sparepart->Jumlah;
                        //     $sparepartdata->save();
                        //     $delete_sparepart = $sparepart->delete();
                        // }
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
            // }
            // else
            // {
                // if($jenis == 'SS' || $jenis == 'SV')
                // {
                //     if($request->has('Detail_Jasa'))
                //     {
                //         $detail_jasas = Detail_Jasa::where('Id_Transaksi',$penjualan->Id_Transaksi)->get();
                //         foreach($detail_jasas as $jasa)
                //         {
                //             $montir = Montir::where('Id_Jasa_Montir',$jasa->Id_Jasa_Montir)->first();
                //             $delete_jasa = $jasa->delete();
                //         }
                //         $jasa       = $request->get('Detail_Jasa');
                //         $countjasa  = count($jasa);
                //         for($i=0; $i<$countjasa;$i++)
                //         {
                //             $jasa[$i]['Id_Jasa_Montir'] = $montir->Id_Jasa_Montir;
                //         }
                //         $penjualan = DB::transaction(function () use($penjualan,$jasa){
                //             $penjualan->detail_jasas()->createMany($jasa);
                //             return $penjualan;  
                //         });
                //     }
                // }
                // if($jenis == 'SS' || $jenis == 'SP')
                // {
                //     if($request->has('Detail_Sparepart'))
                //     {
                //         $detail_spareparts = Detail_Sparepart::where('Id_Transaksi',$penjualan->Id_Transaksi)->get();
                //         foreach($detail_spareparts as $sparepart)
                //         {
                //             $montir = Montir::where('Id_Jasa_Montir',$sparepart->Id_Jasa_Montir)->first();
                //             $sparepartCollection = Sparepart::where('Kode_Sparepart',$sparepart->Kode_Sparepart)->get();
                //             $sparepartdata = $sparepartCollection->first();
                //             $sparepartdata->Jumlah_Sparepart += $sparepart->Jumlah;
                //             $sparepartdata->save();
                //             $delete_sparepart = $sparepart->delete();
                //         }
                //         $sparepart       = $request->get('Detail_Sparepart');
                //         $countsparepart  = count($sparepart);
                //         for($i=0; $i<$countsparepart;$i++)
                //         {
                //             $sparepart[$i]['Id_Jasa_Montir'] = $montir->Id_Jasa_Montir;
                //         }
                //         $penjualan = DB::transaction(function () use($penjualan,$sparepart){
                //             $penjualan->detail_spareparts()->createMany($sparepart);
                //             return $penjualan;  
                //         });
                //     }
                // }
            // }
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
            else
            {
                $penjualan->Total               = $request->get('Subtotal') - $request->get('Diskon');
            }
            // return $penjualan;
            $penjualan->save();
            $response = $this->generateItem($penjualan);
            return $this->sendResponse($response);
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
            
            $delete_jasa = $jasa->delete();

            foreach($montirs as $montir)
            {
                $delete_montir = $montir->delete();
            }
        }
        $spareparts = Detail_Sparepart::where('Id_Transaksi',$id)->get();
        foreach($spareparts as $sparepart)
        {
            $montirs = Montir::where('Id_Jasa_Montir',$sparepart->Id_Jasa_Montir)->get();
            
            $sparepartdata = Sparepart::where('Kode_Sparepart',$sparepart->Kode_Sparepart)->first();
            $sparepartdata->Jumlah_Sparepart += $sparepart->Jumlah;
            $sparepartdata->save();

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

    public function pembayaran(Request $request,$id)
    {
        $penjualan = Transaksi_Penjualan::find($id);
        $penjualan->Status = 3;
        $penjualan->save();
        if($request->Id_Pegawai !== null)
        {
            $pod[0]['Id_Pegawai']=$request->Id_Pegawai;
            $penjualan = DB::transaction(function () use($penjualan,$pod){
                $penjualan->pegawai_on_duties()->createMany($pod);
                return $penjualan;
            });
        }

        $response=$this->generateItem($penjualan);
        return $this->sendResponse($response,201);
    }
    public function showbyID($id)
    {
        $penjualan = Transaksi_Penjualan::find($id);
        return response()->json($penjualan,200);
    }
    public function finish($id)
    {
        $penjualan = Transaksi_Penjualan::find($id);
        $penjualan->Status = 2;
        $penjualan->save();
        $response = $this->generateItem($penjualan);
        return $this->sendResponse($response);
    }

    public function kasirDesktop($id){
        $data = DB::select("SELECT p.Id_Pegawai
        FROM transaksi_penjualans t 
        INNER JOIN pegawai_on_duties m ON m.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id AND t.Status = '3' AND p.Id_Role = '3'");

        return response()->json([
            'status' => (bool) $data,
            'data' => $data,
            'message' => $data ? 'Success' : 'Error',
        ]);
    }
}
