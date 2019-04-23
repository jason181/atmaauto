<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\SparepartTransformers;
use App\Sparepart;
use Illuminate\Support\Facades\DB;

class SparepartController extends RestController
{
    protected $transformer=SparepartTransformers::Class;

    public function index()
    {
        $sparepart=Sparepart::get();
        $response=$this->generateCollection($sparepart);
        return $this->sendResponse($response,201);
    }

    public function sorthargaasc()
    {
        $sparepart = Sparepart::orderBy('Harga_Jual')->get();
        $response=$this->generateCollection($sparepart);
        return $this->sendResponse($response,201);
    }

    public function sorthargadesc()
    {
        $sparepart = Sparepart::orderBy('Harga_Jual','DESC')->get();
        $response=$this->generateCollection($sparepart);
        return $this->sendResponse($response,201);
    }

    public function sortjumlahasc()
    {
        $sparepart = Sparepart::orderBy('Jumlah_Sparepart')->get();
        $response=$this->generateCollection($sparepart);
        return $this->sendResponse($response,201);
    }

    public function sortjumlahdesc()
    {
        $sparepart = Sparepart::orderBy('Jumlah_Sparepart','DESC')->get();
        $response=$this->generateCollection($sparepart);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {
        try{
            $sparepart = new Sparepart;

            if($request->get('Gambar'))
            {
                $image = $request->get('Gambar');
                $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($request->get('Gambar'))->save(public_path('images/').$name);
                $sparepart->Gambar = $name;
            }

            $motorcyle_types = $request->motorcycleTypes;

            $sparepart->Kode_Sparepart=$request->get('Kode_Sparepart');
            $sparepart->Tipe_Barang=$request->get('Tipe_Barang');
            $sparepart->Nama_Sparepart=$request->get('Nama_Sparepart');
            $sparepart->Merk_Sparepart=$request->get('Merk_Sparepart');
            $sparepart->Rak_Sparepart=$request->get('Rak_Sparepart');
            $sparepart->Jumlah_Sparepart=$request->get('Jumlah_Sparepart');
            $sparepart->Stok_Minimum_Sparepart=$request->get('Stok_Minimum_Sparepart');
            $sparepart->Harga_Beli=$request->get('Harga_Beli');
            $sparepart->Harga_Jual=$request->get('Harga_Jual');
            $sparepart->save();

            if($request->has('motorcycleTypes')){
                $sparepart = DB::transaction(function () use ($sparepart,$motorcyle_types){
                    $sparepart->motors()->sync($motorcyle_types);
                    return $sparepart;
                });
            }

            $response = $this->generateItem($sparepart);
            return $this->sendResponse($response, 201);
            
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {   
        try{

            $sparepart = Sparepart::find($id);

            if($request->get('Gambar'))
            {
                $image = $request->get('Gambar');
                $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($request->get('Gambar'))->save(public_path('images/').$name);
                $sparepart->Gambar = $name;
            }

            $sparepart->Tipe_Barang=$request->get('Tipe_Barang');
            $sparepart->Nama_Sparepart=$request->get('Nama_Sparepart');
            $sparepart->Merk_Sparepart=$request->get('Merk_Sparepart');
            $sparepart->Rak_Sparepart=$request->get('Rak_Sparepart');
            $sparepart->Jumlah_Sparepart=$request->get('Jumlah_Sparepart');
            $sparepart->Stok_Minimum_Sparepart=$request->get('Stok_Minimum_Sparepart');
            $sparepart->Harga_Beli=$request->get('Harga_Beli');
            $sparepart->Harga_Jual=$request->get('Harga_Jual');
            $sparepart->save();

            $response = $this->generateItem($sparepart);
            return $this->sendResponse($response, 201);
            
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
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
