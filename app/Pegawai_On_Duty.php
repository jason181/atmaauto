<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai_On_Duty extends Model
{
    //
    protected $table = 'Pegawai_On_Duty';
    protected $primaryKey = 'Id_Duty';
    public $timestamp = true;
    protected $fillable = [
        'Id_Pegawai',
        'Id_Transaksi'
    ];

    public function pegawais()
    {
        return $this->belongsTo('App\Pegawai');
    }

    public function transaksi_penjualans()
    {
        return $this->belongsTo('App\Transaksi_Penjualan');
    }
}
