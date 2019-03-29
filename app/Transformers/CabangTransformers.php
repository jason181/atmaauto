<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Cabang;

class CabangTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Cabang $cabang)
    {
        return [
            'id'                    => $cabang->Id_Cabang,
            'Nama_Cabang'           => $cabang->Nama_Cabang,
            'Alamat_Cabang'         => $cabang->Alamat_Cabang,
            'Telepon_Cabang'        => $cabang->Telepon_Cabang,
        ];
    }
}