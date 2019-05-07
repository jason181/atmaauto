<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Transaksi_Penjualan;

class TransaksiPenjualanTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */

    // protected $defaultIncludes = [
    //     // 'detail_jasa',
    //     // 'detail_sparepart',
    //     'pegawai_on_duty'
    // ];
    public function transform(Transaksi_Penjualan $transaksi_penjualan)
    {
        return [
            'Id_Transaksi'      =>$transaksi_penjualan->Id_Transaksi,
            'Id_Konsumen'       =>$transaksi_penjualan->Id_Konsumen,
            'Tanggal_Transaksi' =>$transaksi_penjualan->Tanggal_Transaksi,
            'Jenis_Transaksi'   =>$transaksi_penjualan->Jenis_Transaksi,
            'Subtotal'          =>$transaksi_penjualan->Subtotal,
            'Diskon'            =>$transaksi_penjualan->Diskon,
            'Total'             =>$transaksi_penjualan->Total,
            'Status'            =>$transaksi_penjualan->Status
        ];
    }
    // public function includeDetailJasa(Transaksi_Penjualan $transaksi_penjualan)
    // {
    //     return $this->collection($transaksi_penjualan->detail_jasas, new DetailJasaTransformers);
    // }
    // public function includeDetailSparepart(Transaksi_Penjualan $transaksi_penjualan)
    // {
    //     return $this->collection($transaksi_penjualan->detail_spareparts, new DetailSparepartTransformers);
    // }
    // public function includePegawaiOnDuty(Transaksi_Penjualan $transaksi_penjualan)
    // {
    //     return $this->collection($transaksi_penjualan->pegawai_on_duties, new Pegawai_On_Duty);
    // }
}
?>
