<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Motor_Konsumen;


class MotorKonsumenTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Motor_Konsumen $motor_konsumen)
    {
        return [
            'Id_Motor_Konsumen' => $motor_konsumen->Id_Motor_Konsumen,
            'Id_Konsumen'       => $motor_konsumen->Id_Konsumen,
            'Nama_Konsumen'     => $motor_konsumen->konsumens->Nama_Konsumen,
            'Id_Motor'          => $motor_konsumen->Id_Motor,
            'Merk'              => $motor_konsumen->motors->Merk,
            'Tipe'              => $motor_konsumen->motors->Tipe,
            'Plat_Kendaraan'    => $motor_konsumen->Plat_Kendaraan,
        ];
    }
}