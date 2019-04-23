<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\MotorTransformers;
use App\Motor;

class MotorController extends RestController
{
    protected $transformer=MotorTransformers::Class;
    public function index()
    {
        $motor=Motor::get();
        $response=$this->generateCollection($motor);
        return $this->sendResponse($response,201);
    }
    public function store(Request $request)
    {
        $motor = Motor::create([
            'Merk' => $request->Merk,
            'Tipe' => $request->Tipe
        ]);

        return response()->json([
            'status' => (bool) $motor,
            'data' => $motor,
            'message' => $motor ? 'Success' : 'Error Cabang'
        ]);
    }
    public function update(Request $request, $id)
    {   
        $motor = Motor::find($id);

        if(!is_null($request->Merk)){
            $motor->Merk = $request->Merk;
        }
        if(!is_null($request->Tipe)){
            $motor->Tipe = $request->Tipe;
        }

        $success = $motor->save();
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }
}
