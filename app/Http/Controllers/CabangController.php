<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\CabangTransformers;
use App\Cabang;

class CabangController extends RestController
{
    protected $transformer=CabangTransformers::Class;

    public function index()
    {
        $cabang=Cabang::get();
        $response=$this->generateCollection($cabang);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {
        $cabang = Cabang::create([
            'Nama_Cabang' => $request->Nama_Cabang,
            'Alamat_Cabang' => $request->Alamat_Cabang,
            'Telepon_Cabang' => $request->Telepon_Cabang
        ]);

        return response()->json([
            'status' => (bool) $cabang,
            'data' => $cabang,
            'message' => $cabang ? 'Success' : 'Error Cabang'
        ]);
    }

    public function update(Request $request, $id)
    {   
        $cabang = Cabang::find($id);

        if(!is_null($request->Nama_Cabang)){
            $cabang->Nama_Cabang = $request->Nama_Cabang;
        }
        if(!is_null($request->Alamat_Cabang)){
            $cabang->Alamat_Cabang = $request->Alamat_Cabang;
        }
        if(!is_null($request->Telepon_Cabang)){
            $cabang->Telepon_Cabang = $request->Telepon_Cabang;
        }

        $success = $cabang->save();
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }

    public function showbyID($id)
    {
        $cabang = Cabang::find($id);
        return response()->json($cabang,200);
    }

    public function destroy($id)
    {
        $cabang = Cabang::find($id);
        $status = $cabang->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }    
}
