<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_Sparepart extends Model
{
    //
    protected $table = 'detail_spareparts';
    protected $primaryKey = 'Id_Detail_Sparepart';
    public $timestamp = true;
    protected $fillable = [
        'Id_Detail_Sparepart',
        'Id_Transaksi',
        'Id_Jasa_Montir',
        'Kode_Sparepart',
        'Harga_Satuan',
        'Jumlah',
        'Subtotal_Detail_Sparepart'
    ];

    public function spareparts()
    {
        return $this->belongsTo('App\Sparepart');
    }
    
    public function transaksi_penjualan()
    {
        return $this->belongsTo('App\Transaksi_Penjualan');
    }

    public function montirs()
    {
        return $this->belongsTo('App\Montir');
    }
}
