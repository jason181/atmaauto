<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi_Penjualan;
use App\Detail_Jasa;
use App\Detail_Sparepart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Transformers\TransaksiPenjualanTransformers;

class TransaksiPenjualanController extends RestController
{
    //
    protected $transformer = TransaksiPenjualanTransformers::Class;
}
