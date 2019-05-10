<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Detail_Jasa;

class DetailJasaTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Detail_Jasa $detail_jasa)
    {
        return [
            'Id_Detail_Jasa'        => $detail_jasa->Id_Detail_Jasa,
            'Id_Transaksi'          => $detail_jasa->Id_Transaksi,
            'Id_Jasa'               => $detail_jasa->Id_Jasa,
            'Nama_Jasa'             => $detail_jasa->jasas->Nama_Jasa,
            'Harga_Jasa'            => $detail_jasa->jasas->Harga_Jasa,
            'Id_Jasa_Montir'        => $detail_jasa->Id_Jasa_Montir,
            'Subtotal_Detail_Jasa'  => $detail_jasa->Subtotal_Detail_Jasa,
        ];
    }
}