<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Montir;

class MontirTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Montir $montir)
    {
        return [
            'Id_Jasa_Montir'        => $konsumen->Id_Konsumen,
            'Nama_Konsumen'         => $konsumen->Nama_Konsumen,
            'Alamat_Konsumen'       => $konsumen->Alamat_Konsumen,
            'Telepon_Konsumen'      => $konsumen->Telepon_Konsumen,
        ];
    }
}