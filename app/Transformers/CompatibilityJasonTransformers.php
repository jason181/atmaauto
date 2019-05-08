<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\CompatibilityJason;

class CompatibilityJasonTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(CompatibilityJason $compatibilityjason)
    {
        return [
            'Id_Compatibility'  => $compatibilityjason->Id_Compatibility,
            'Id_Motor'          => $compatibilityjason->Id_Motor,
            'Kode_Sparepart'    => $compatibilityjason->Kode_Sparepart,
        ];
    }
}