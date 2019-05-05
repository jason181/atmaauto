<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail_Pengadaan extends Model
{
    //
    use SoftDeletes;
    protected $table = 'detail_pengadaans';
    protected $primaryKey = 'Id_Detail_Pengadaan';
    public $timestamp = true;
    protected $fillable = [
        'Id_Pengadaan',
        'Kode_Sparepart',
        'Harga_Satuan',
        'Jumlah',
        'Subtotal_Pengadaan'
    ];

    public function spareparts()
    {
        return $this->belongsTo('App\Sparepart','Id_Sparepart');
    }

    public function transaksi_pengadaans()
    {
        return $this->belongsTo('App\Transaksi_Pengadaan','Id_Pengadaan');
    }
}
