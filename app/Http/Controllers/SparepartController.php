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
        try{
            $sparepart = new Sparepart;

            // if($request->hasfile('Gambar'))
            // {
            //     $file = $request->file('Gambar');
            //     $name= time().$file->getClientOriginalName();
            //     $file->move(public_path().'/images/', $name);
            //     //return response()->json(['uploaded' => '/images/'.$name]);
            //     $sparepart->Gambar=$name;
            // }

            if($request->get('Gambar'))
            {
                $image = $request->get('Gambar');
                $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($request->get('Gambar'))->save(public_path('images/').$name);
                $sparepart->Gambar = $name;
            }

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

            //$sparepart->Kode_Sparepart=$request->get('Kode_Sparepart');
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
