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
    protected $defaultIncludes = [
        'compatibility'
    ];

    public function transform(Sparepart $sparepart)
    {
        return [
            'Kode_Sparepart'         =>$sparepart->Kode_Sparepart,
            'Nama_Sparepart'         =>$sparepart->Nama_Sparepart,
            'Merk_Sparepart'         =>$sparepart->Merk_Sparepart,
            'Tipe_Barang'            =>$sparepart->Tipe_Barang,
            'Rak_Sparepart'          =>$sparepart->Rak_Sparepart,
            'Jumlah_Sparepart'       =>$sparepart->Jumlah_Sparepart,
            'Stok_Minimum_Sparepart' =>$sparepart->Stok_Minimum_Sparepart,
            'Harga_Beli'             =>$sparepart->Harga_Beli,
            'Harga_Jual'             =>$sparepart->Harga_Jual,
            'Gambar'                 =>$sparepart->Gambar,
        ];
    }
    public function includeCompatibility(Sparepart $sparepart)
    {
        return $this->collection($sparepart->motors, new CompatibilityTransformers);
    }
}