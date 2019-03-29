<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Konsumen;

class KonsumenTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Konsumen $konsumen)
    {
        return [
            'id'                    => $konsumen->Id_Konsumen,
            'Nama_Konsumen'         => $konsumen->Nama_Konsumen,
            'Alamat_Konsumen'       => $konsumen->Alamat_Konsumen,
            'Telepon_Konsumen'      => $konsumen->Telepon_Konsumen,
        ];
    }
}