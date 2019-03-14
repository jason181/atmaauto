<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonsumenController extends Controller
{
    public function index()
    {
        return response()->json(Konsumen::all(),200);
    }

    public function store(Request $request)
    {
        $konsumen = Konsumen::create([
            'Nama_Konsumen' => $request->Nama_Konsumen,
            'Telepon_Konsumen' => $request->Telepon_Konsumen,
            'Alamat_Konsumen' => $request->Alamat_Konsumen
        ]);

        return response()->json([
            'status' => (bool) $konsumen,
            'data' => $konsumen,
            'message' => $konsumen ? 'Success' : 'Error Konsumen'
        ]);
    }

    public function update(Request $request, $id)
    {   
        $konsumen = Konsumen::find($id);

        if(!is_null($request->Nama_Konsumen)){
            $konsumen->Nama_Konsumen = $request->Nama_Konsumen;
        }
        if(!is_null($request->Alamat_Konsumen)){
            $konsumen->Alamat_Konsumen = $request->Alamat_Konsumen;
        }
        if(!is_null($request->Telepon_Konsumen)){
            $konsumen->Telepon_Konsumen = $request->Telepon_Konsumen;
        }
        $success = $konsumen->save();
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }

    public function showbyID($id)
    {
        $konsumen = Konsumen::find($id);
        return response()->json($konsumen,200);
    }

    public function destroy($id)
    {
        $konsumen = Konsumen::find($id);
        $status = $konsumen->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }
}
