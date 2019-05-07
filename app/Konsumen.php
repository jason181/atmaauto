<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Konsumen extends Model
{
    //
    use SoftDeletes;
    protected $table = 'konsumens';
    protected $primaryKey = 'Id_Konsumen';
    public $timestamp = true;
    protected $fillable = [
        'Nama_Konsumen',
        'Alamat_Konsumen',
        'Telepon_Konsumen'
    ];

    public function transaksi_penjualans()
    {
        return $this->hasMany('App\Transaksi_Penjualan','Id_Transaksi');
    }

    public function motor_konsumens()
    {
        return $this->hasMany('App\Motor_Konsumen','Id_Motor_Konsumen');
    }

}
