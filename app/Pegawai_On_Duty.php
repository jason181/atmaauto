<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai_On_Duty extends Model
{
    //
    use SoftDeletes;
    protected $table = 'pegawai_on_duties';
    protected $primaryKey = 'Id_Duty';
    public $timestamp = true;
    protected $fillable = [
        'Id_Pegawai',
        'Id_Transaksi'
    ];

    public function pegawais()
    {
        return $this->belongsTo('App\Pegawai','Id_Pegawai');
    }

    public function transaksi_penjualans()
    {
        return $this->belongsTo('App\Transaksi_Penjualan','Id_Transaksi');
    }
}
