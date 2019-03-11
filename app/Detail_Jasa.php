<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_Jasa extends Model
{
    //
    protected $table = 'detail_jasas';
    protected $primaryKey = 'Id_Detail_Jasa';
    public $timestamp = true;
    protected $fillable = [
        'Id_Detail_Jasa',
        'Id_Transaksi',
        'Id_Jasa_Montir',
        'Subtotal_Detail_Jasa'
    ];

    public function jasas()
    {
        return $this->belongsTo('App\Jasa');
    }
    
    public function transaksi_penjualan()
    {
        return $this->belongsTo('App\Transaksi_Penjualan');
    }

    public function montirs()
    {
        return $this->belongsTo('App\Montir');
    }
}
