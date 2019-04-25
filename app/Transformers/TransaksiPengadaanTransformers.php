<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transaksi_Pengadaan;

class TransaksiPengadaanTransformers extends TransformerAbstract
{
    protected $defaultIncludes = [
        'detail'
    ];
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Transaksi_Pengadaan $transaksi_pengadaan)
    {
        return [
            'Id_Pengadaan'          =>$transaksi_pengadaan->Id_Pengadaan,
            'Id_Supplier'           =>$transaksi_pengadaan->Id_Supplier,
            // 'Nama_Supplier'         =>$transaksi_pengadaan->suppliers->Nama_Supplier,
            // 'Nama_Sales'            =>$transaksi_pengadaan->suppliers->Nama_Sales,
            'Tanggal_Pengadaan'     =>$transaksi_pengadaan->Tanggal_Pengadaan,
            'Total_Harga'           =>$transaksi_pengadaan->Total_Harga,
            'Status_Pengadaan'      =>$transaksi_pengadaan->Status_Pengadaan,
        ];
    }

    // public function includeDetail(Transaksi_Pengadaan $transaksi_pengadaan)
    // {
    //     return $this->collection($transaksi_pengadaan->detail_pengadaans, new DetailPengadaanTransformers);
    // }
}
?>