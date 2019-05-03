<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Transformers\MotorKonsumenTransformers;
use App\Motor_Konsumen;

class MotorKonsumenController extends RestController
{
    protected $transformer=MotorKonsumenTransformers::Class;
    public function index()
    {
        $motor_konsumen=Motor_Konsumen::get();
        $response=$this->generateCollection($motor_konsumen);
        return $this->sendResponse($response,201);
    }
    // public function showmotorkonsumen($id)
    // {
    //     $motor_konsumen=Motor_Konsumen::find($id);
    //     $response=$this->generateCollection($motor_konsumen);
    //     return $this->sendResponse($response,201);
    // }
    
    public function store(Request $request)
    {
        $motor_konsumen = Motor_Konsumen::create([
            'Id_Konsumen'    => $request->Id_Konsumen,
            'Id_Motor'       => $request->Id_Motor,
            'Plat_Kendaraan' => $request->Plat_Kendaraan,
        ]);
        return response()->json([
            'status' => (bool) $motor_konsumen,
            'data' => $motor_konsumen,
            'message' => $motor_konsumen ? 'Success' : 'Error Motor'
        ]);
    }
    public function update(Request $request, $id)
    {   
        $motor_konsumen = Motor_Konsumen::find($id);
        // if(!is_null($request->Id_Konsumen)){
        //     $motor_konsumen->Id_Konsumen = $request->Id_Konsumen;
        // }
        if(!is_null($request->Id_Motor)){
            $motor_konsumen->Id_Motor = $request->Id_Motor;
        }
        if(!is_null($request->Plat_Kendaraan)){
            $motor_konsumen->Plat_Kendaraan = $request->Plat_Kendaraan;
        }
        $success = $motor_konsumen->save();
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }
    public function showbyCustomer($id){
        try {
            $motor_konsumen=Motor_Konsumen::where('Id_Konsumen',$id)->get();
                $response = $this->generateCollection($motor_konsumen);
                return $this->sendResponse($response);
        } catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('Motor Tidak Ditemukan');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $motor_konsumen = Motor_Konsumen::find($id);
        $status = $motor_konsumen->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }
}