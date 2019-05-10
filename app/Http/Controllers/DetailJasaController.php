<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\DetailJasaTransformers;
use App\Detail_Jasa;

class DetailJasaController extends RestController
{
    protected $transformer=DetailJasaTransformers::Class;

    public function index()
    {
        $detail_jasa=Detail_Jasa::get();
        $response=$this->generateCollection($detail_jasa);
        return $this->sendResponse($response,201);
    }
}
