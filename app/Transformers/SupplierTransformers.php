<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Supplier;

class SupplierTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Supplier $supplier)
    {
        return [
            'id'                => $supplier->Id_Supplier,
            'Nama_Supplier'     => $supplier->Nama_Supplier,
            'Alamat_Supplier'   => $supplier->Alamat_Supplier,
            'Telepon_Supplier'  => $supplier->Telepon_Supplier,
            'Nama_Sales'        => $supplier->Nama_Sales,
            'Telepon_Sales'     => $supplier->Telepon_Sales
        ];
    }
}