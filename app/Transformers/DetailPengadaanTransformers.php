<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Detail_Pengadaan;

class DetailPengadaanTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Detail_Pengadaan $detail_pengadaan)
    {
        return [
            'Id_Detail_Pengadaan'   => $detail_pengadaan->Id_Detail_Pengadaan,
            'Id_Pengadaan'          => $detail_pengadaan->Id_Pengadaan,
            'Kode_Sparepart'        => $detail_pengadaan->Kode_Sparepart,
            'Harga_Satuan'          => $detail_pengadaan->Harga_Satuan,
            'Jumlah'                => $detail_pengadaan->Jumlah,
            'Subtotal_Pengadaan'    => $detail_pengadaan->Subtotal_Pengadaan,
        ];
    }
}