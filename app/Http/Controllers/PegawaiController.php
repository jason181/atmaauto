<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\PegawaiTransformers;
use App\Pegawai;

class PegawaiController extends RestController
{
    protected $transformer=PegawaiTransformers::Class;

    public function index()
    {
        $pegawai=Pegawai::get();
        $response=$this->generateCollection($pegawai);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {
        $pegawai = Pegawai::create([
            'Nama_Pegawai' => $request->Nama_Pegawai,
            'Alamat_Pegawai' => $request->Alamat_Pegawai,
            'Telepon_Pegawai' => $request->Telepon_Pegawai,
            'Gaji_Pegawai' => $request->Gaji_Pegawai,
            'Username' => $request->Username,
            'Password' => $request->Password,
        ]);

        return response()->json([
            'status' => (bool) $pegawai,
            'data' => $pegawai,
            'message' => $pegawai ? 'Success' : 'Error Pegawai'
        ]);
    }

    public function update(Request $request, $id)
    {   
        $pegawai = Pegawai::find($id);

        if(!is_null($request->Nama_Pegawai)){
            $cabang->Nama_Pegawai = $request->Nama_Pegawai;
        }
        if(!is_null($request->Alamat_Pegawai)){
            $cabang->Alamat_Pegawai = $request->Alamat_Pegawai;
        }
        if(!is_null($request->Telepon_Pegawai)){
            $cabang->Telepon_Pegawai = $request->Telepon_Pegawai;
        }
        if(!is_null($request->Gaji_Pegawai)){
            $cabang->Gaji_Pegawai = $request->Gaji_Pegawai;
        }

        $success = $pegawai->save();
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }

    public function showbyID($id)
    {
        $pegawai = Pegawai::find($id);
        return response()->json($pegawai,200);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $status = $pegawai->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }    
}
