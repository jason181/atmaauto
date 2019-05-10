<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\DetailSparepartTransformers;
use App\Detail_Sparepart;

<<<<<<< HEAD
class DetailSparepartController extends RestController
{
    protected $transformer=DetailSparepartTransformers::Class;

    public function index()
    {
        $detail_sparepart=Detail_Sparepart::get();
        $response=$this->generateCollection($detail_sparepart);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {
        $detail_sparepart = Detail_Sparepart::create([
            'Kode_Sparepart'            => $request->Kode_Sparepart,
            'Harga_Satuan'              => $request->Harga_Satuan,
            'Jumlah'                    => $request->Jumlah,
            'Subtotal_Detail_Sparepart' => $request->Subtotal_Detail_Sparepart
        ]);

        $response = $this->generateItem($detail_sparepart);
        return $this->sendResponse($response);
    }
=======


class DetailSparepartController extends Controller
{
    //

>>>>>>> 6d2b5fa30b113f19e21d6a6a2fbb135293cc4fa6
}
