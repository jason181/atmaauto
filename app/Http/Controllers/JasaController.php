<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\JasaTransformers;
use App\Jasa;

class JasaController extends RestController
{
    protected $transformer=JasaTransformers::Class;

    public function index()
    {
        $jasa=Jasa::get();
        $response=$this->generateCollection($jasa);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {
        $jasa = Jasa::create([
            'Nama_Jasa' => $request->Nama_Jasa,
            'Harga_Jasa' => $request->Harga_Jasa
        ]);

        return response()->json([
            'status' => (bool) $jasa,
            'data' => $jasa,
            'message' => $jasa ? 'Success' : 'Error Jasa'
        ]);
    }

    public function update(Request $request, $id)
    {   
        $jasa = Jasa::find($id);

        if(!is_null($request->Nama_Jasa)){
            $jasa->Nama_Jasa = $request->Nama_Jasa;
        }
        if(!is_null($request->Harga_Jasa)){
            $jasa->Harga_Jasa = $request->Harga_Jasa;
        }

        $success = $jasa->save();
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }

    public function showbyID($id)
    {
        $jasa = Jasa::find($id);
        return response()->json($jasa,200);
    }

    public function destroy($id)
    {
        $jasa = Jasa::find($id);
        $status = $jasa->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }
}
