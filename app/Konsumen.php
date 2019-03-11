<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    //
    protected $table = 'konsumens';
    protected $primaryKey = 'Id_Konsumen';
    public $timestamp = true;
    protected $fillable = [
        'Id_Konsumen',
        'Nama_Konsumen',
        'Alamat_Konsumen',
        'Telepon_Konsumen'
    ];

    public function transaksi_penjualans()
    {
        return $this->hasMany('App\Transaksi_Penjualan');
    }

    public function motor_konsumens()
    {
        return $this->hasMany('App\Motor_Konsumen');
    }

}
