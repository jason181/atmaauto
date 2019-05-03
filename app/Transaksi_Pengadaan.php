<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi_Pengadaan extends Model
{
    use SoftDeletes;
    
    protected $table = 'transaksi_pengadaans';
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
        return $this->hasMany('App\Detail_Pengadaan','Id_Detail_Pengadaan');
    }

    public function suppliers()
    {
        return $this->belongsTo('App\Supplier','Id_Supplier');
    }

}
