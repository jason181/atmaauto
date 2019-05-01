<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    
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
