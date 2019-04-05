<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Jasa;

class JasaTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Jasa $jasa)
    {
        return [
            'Id_Jasa'           => $jasa->Id_Jasa,
            'Nama_Jasa'         => $jasa->Nama_Jasa,
            'Harga_Jasa'        => $jasa->Harga_Jasa,
        ];
    }
}