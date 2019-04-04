<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Sparepart;

class SparepartTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Sparepart $sparepart)
    {
        return [
            'Kode_Sparepart'         =>$sparepart->Kode_Sparepart,
            'Nama_Sparepart'         =>$sparepart->Nama_Sparepart,
            'Merk_Sparepart'         =>$sparepart->Merk_Sparepart,
            'Rak_Sparepart'          =>$sparepart->Rak_Sparepart,
            'Jumlah_Sparepart'       =>$sparepart->Jumlah_Sparepart,
            'Stok_Minimum_Sparepart' =>$sparepart->Stok_Minimum_Sparepart,
            'Harga_Beli'             =>$sparepart->Harga_Beli,
            'Harga_Jual'             =>$sparepart->Harga_Jual,
            'Gambar'                 =>$sparepart->Gambar,    
        ];
    }
}