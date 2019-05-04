<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Detail_Pengadaan;
// use App\Supplier;

class DetailPengadaanTransformers extends TransformerAbstract
{
    // protected $defaultIncludes = [
    //     'detail'
    // ];
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Detail_Pengadaan $detail_pengadaan)
    {
        return [
            'Id_Detail_Pengadaan'   => $detail_pengadaan->Id_Detail_Pengadaan,
            'Id_Pengadaan'          => $detail_pengadaan->Id_Pengadaan,
            'Kode_Sparepart'        => $detail_pengadaan->Kode_Sparepart,
            'Jumlah'                => $detail_pengadaan->Jumlah,
            'Harga_Satuan'          => $detail_pengadaan->Harga_Satuan,
            'Subtotal_Pengadaan'    => $detail_pengadaan->Subtotal_Pengadaan,
        ];
    }
 
}
?>