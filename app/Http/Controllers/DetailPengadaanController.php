<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\DetailPengadaanTransformers;
use App\Detail_Pengadaan;

class DetailPengadaanController extends RestController
{
    protected $transformer=DetailPengadaanTransformers::Class;

    public function index()
    {
        $detail_pengadaan=Detail_Pengadaan::get();
        $response=$this->generateCollection($detail_pengadaan);
        return $this->sendResponse($response,201);
    }
}
