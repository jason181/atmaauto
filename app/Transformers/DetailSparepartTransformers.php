<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Detail_Sparepart;

class DetailSparepartTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Detail_Sparepart $detail_sparepart)
    {
        return [
            'Id_Detail_Sparepart'           => $detail_sparepart->Id_Detail_Sparepart,
            'Id_Transaksi'                  => $detail_sparepart->Id_Transaksi,
            'Id_Jasa_Montir'                => $detail_sparepart->Id_Jasa_Montir,
            'Kode_Sparepart'                => $detail_sparepart->Kode_Sparepart,
            'Nama_Sparepart'                => $detail_sparepart->spareparts->Nama_Sparepart,
            'Harga_Satuan'                  => $detail_sparepart->Harga_Satuan,
            'Jumlah'                        => $detail_sparepart->Jumlah,
            'Subtotal_Detail_Sparepart'     => $detail_sparepart->Subtotal_Detail_Sparepart,
        ];
    }
}