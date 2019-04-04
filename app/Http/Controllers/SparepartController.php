<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\SparepartTransformers;
use App\Sparepart;

class SparepartController extends RestController
{
    protected $transformer=SparepartTransformers::Class;

    public function index()
    {
        $sparepart=Sparepart::get();
        $response=$this->generateCollection($sparepart);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {
        $sparepart = Sparepart::create([
            'Kode_Sparepart'         =>$request->Kode_Sparepart,
            'Nama_Sparepart'         =>$request->Nama_Sparepart,
            'Merk_Sparepart'         =>$request->Merk_Sparepart,
            'Rak_Sparepart'          =>$request->Rak_Sparepart,
            'Jumlah_Sparepart'       =>$request->Jumlah_Sparepart,
            'Stok_Minimum_Sparepart' =>$request->Stok_Minimum_Sparepart,
            'Harga_Beli'             =>$request->Harga_Beli,
            'Harga_Jual'             =>$request->Harga_Jual,
            'Gambar'                 =>$request->Gambar,
        ]);

        return response()->json([
            'status' => (bool) $sparepart,
            'data' => $sparepart,
            'message' => $sparepart ? 'Success' : 'Error Sparepart'
        ]);
    }

    public function update(Request $request, $id)
    {   
        $sparepart = Sparepart::find($id);

        if(!is_null($request->Kode_Sparepart)){
            $sparepart->Kode_Sparepart = $request->Kode_Sparepart;
        }
        if(!is_null($request->Nama_Sparepart)){
            $sparepart->Nama_Sparepart = $request->Nama_Sparepart;
        }
        if(!is_null($request->Merk_Sparepart)){
            $sparepart->Merk_Sparepart = $request->Merk_Sparepart;
        }
        if(!is_null($request->Rak_Sparepart)){
            $sparepart->Rak_Sparepart = $request->Rak_Sparepart;
        }
        if(!is_null($request->Jumlah_Sparepart)){
            $sparepart->Jumlah_Sparepart = $request->Jumlah_Sparepart;
        }
        if(!is_null($request->Stok_Minimum_Sparepart)){
            $sparepart->Stok_Minimum_Sparepart = $request->Stok_Minimum_Sparepart;
        }
        if(!is_null($request->Harga_Beli)){
            $sparepart->Harga_Beli = $request->Harga_Beli;
        }
        if(!is_null($request->Harga_Jual)){
            $sparepart->Harga_Jual = $request->Harga_Jual;
        }
        if(!is_null($request->Gambar)){
            $sparepart->Gambar = $request->Gambar;
        }

        $success = $sparepart->save();
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }

    public function showbyID($id)
    {
        $sparepart = Sparepart::find($id);
        return response()->json($sparepart,200);
    }

    public function destroy($id)
    {
        $sparepart = Sparepart::find($id);
        $status = $sparepart->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }
}
