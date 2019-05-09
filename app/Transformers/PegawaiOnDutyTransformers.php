<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Pegawai_On_Duty;

class PegawaiOnDutyTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Pegawai_On_Duty $pod)
    {
        return [
            'Id_Duty'       => $pod->Id_Duty,
            'Id_Pegawai'    => $pod->Id_Pegawai,
            'Id_Transaksi'  => $pod->Id_Transaksi,
        ];
    }
}