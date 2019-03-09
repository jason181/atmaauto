<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi_Penjualan extends Model
{
    //
    protected $table = 'Transaksi_Penjualan';
    protected $primaryKey = 'Id_Transaksi';
    public $timestamp = true;
    protected $fillable = [
        'Id_Transaksi',
        'Id_Konsumen',
        'Tanggal_Transaksi',
        'Jenis_Transaksi',
        'Subtotal',
        'Diskon',
        'Total',
        'Status',
    ];

    public function detail_spareparts()
    {
        return $this->hasMany('App\Detail_Sparepart');
    }
    
    public function detail_jasas()
    {
        return $this->hasMany('App\Detail_Jasa');
    }

    public function pegawai_on_duties()
    {
        return $this->hasMany('App\Pegawai_On_Duty');
    }

    public function konsumens()
    {
        return $this->belongsTo('App\Konsumen');
    }
}
