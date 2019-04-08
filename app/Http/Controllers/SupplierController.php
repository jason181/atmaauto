<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\SupplierTransformers;
use App\Supplier;

class SupplierController extends RestController
{
    protected $transformer=SupplierTransformers::Class;

    public function index()
    {
        $supplier=Supplier::get();
        $response=$this->generateCollection($supplier);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {
        $supplier = Supplier::create([
            'Nama_Supplier' => $request->Nama_Supplier,
            'Alamat_Supplier' => $request->Alamat_Supplier,
            'Telepon_Supplier' =>$request->Telepon_Supplier,
            'Nama_Sales' =>$request->Nama_Sales,
            'Telepon_Sales' =>$request->Telepon_Sales
        ]);

        return response()->json([
            'status' => (bool) $supplier,
            'data' => $supplier,
            'message' => $supplier ? 'Success' : 'Error Supplier'
        ]);
    }

    public function update(Request $request, $id)
    {   
        $supplier = Supplier::find($id);

        if(!is_null($request->Nama_Supplier)){
            $supplier->Nama_Supplier = $request->Nama_Supplier;
        }
        if(!is_null($request->Alamat_Supplier)){
            $supplier->Alamat_Supplier = $request->Alamat_Supplier;
        }
        if(!is_null($request->Telepon_Supplier)){
            $supplier->Telepon_Supplier = $request->Telepon_Supplier;
        }
        // if(!is_null($request->Nama_Sales)){
        //     $supplier->Nama_Sales = $request->Nama_Sales;
        // }
        // if(!is_null($request->Telepon_Sales)){
        //     $supplier->Telepon_Sales = $request->Telepon_Sales;
        // }

        $success = $supplier->save();
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }

    public function showbyID($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier,200);
    }

    public function destroy($id)
    {

        try{
            $supplier = Supplier::find($id);
            $status = $supplier->delete();
            return response()->json('success',200);
        }catch(ModelNotFoundException $e){
            return $this->sendNotFoundResponse('supplier not found');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }        
    }

    public function upSales(Request $request, $id)
    {
        $supplier= Supplier::find($id);
        
            $supplier->Nama_Sales = $request->Nama_Sales;
            $supplier->Telepon_Sales = $request->Telepon_Sales;

        $success = $supplier->save();
        //return $supplier;   
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }

    public function delSales($id)
    {
        $supplier = Supplier::find($id);

        $supplier->Nama_Sales = null;
        $supplier->Telepon_Sales = null;

        $success = $supplier->save();
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }
}
