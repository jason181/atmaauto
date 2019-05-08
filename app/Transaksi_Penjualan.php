<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi_Penjualan extends Model
{
    //
    use SoftDeletes;
    protected $table = 'transaksi_penjualans';
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
        'Status'
    ];

    public function detail_spareparts()
    {
        return $this->hasMany('App\Detail_Sparepart','Id_Transaksi');
    }
    
    public function detail_jasas()
    {
        return $this->hasMany('App\Detail_Jasa','Id_Transaksi');
    }

    public function pegawai_on_duties()
    {
        return $this->hasMany('App\Pegawai_On_Duty','Id_Transaksi');
    }

    public function konsumens()
    {
        return $this->belongsTo('App\Konsumen','Id_Konsumen');
    }
}
