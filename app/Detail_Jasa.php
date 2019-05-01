<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail_Jasa extends Model
{
    use SoftDeletes;
    
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
        return $this->belongsTo('App\Jasa','Id_Jasa');
    }
    
    public function transaksi_penjualan()
    {
        return $this->belongsTo('App\Transaksi_Penjualan','Id_Transaksi');
    }

    public function montirs()
    {
        return $this->belongsTo('App\Montir','Id_Jasa_Montir');
    }
}

