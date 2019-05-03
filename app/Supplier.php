<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table = 'suppliers';
    protected $primaryKey = 'Id_Supplier';
    public $timestamp = true;
    protected $fillable = [
        'Nama_Supplier',
        'Alamat_Supplier',
        'Telepon_Supplier',
        'Nama_Sales',
        'Telepon_Sales'
    ];

    public function transaksi_pengadaans()
    {
        return $this->hasMany('App\Transaksi_Pengadaan','Id_Pengadaan');
    }

}
