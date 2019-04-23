<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Motor;

class CompatibilityTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Motor $motor)
    {
        return [
            'Id_Motor'     => $motor->Id_Motor,
            'Merk'         => $motor->Merk,
            'Tipe'         => $motor->Tipe,
        ];
    }
}