<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\DetailSparepartTransformers;
use App\Detail_Sparepart;

class DetailSparepartController extends RestController
{
    protected $transformer=DetailSparepartTransformers::Class;

    public function index()
    {
        $detail_sparepart=Detail_Sparepart::get();
        $response=$this->generateCollection($detail_sparepart);
        return $this->sendResponse($response,201);
    }
}
