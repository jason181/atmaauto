<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi_Pengadaan extends Model
{
    //
    protected $table = 'Transaksi_Pengadaan';
    protected $primaryKey = 'Id_Pengadaan';
    public $timestamp = true;
    protected $fillable = [
        'Id_Supplier',
        'Tanggal_Pengadaan',
        'Total_Harga',
        'Status_Pengadaan'
    ];

    public function detail_pengadaans()
    {
        return $this->hasMany('App\Detail_Pengadaan');
    }

    public function suppliers()
    {
        return $this->belongsTo('App\Supplier');
    }

}
