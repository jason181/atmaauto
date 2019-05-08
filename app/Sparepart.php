<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sparepart extends Model
{
    //
    use SoftDeletes;
    protected $table = 'spareparts';
    protected $primaryKey = 'Kode_Sparepart';
    public $timestamp = true;
    public $incrementing = false;
    protected $fillable = [
        'Kode_Sparepart',
        'Tipe_Barang',
        'Nama_Sparepart',
        'Merk_Sparepart',
        'Rak_Sparepart',
        'Jumlah_Sparepart',
        'Stok_Minimum_Sparepart',
        'Harga_Beli',
        'Harga_Jual',
        'Gambar'
    ];

    public function detail_pengadaans()
    {
        return $this->hasMany('App\Detail_Pengadaan','Id_Detail_Pengadaan');
    }

    public function motors()
    {
        return $this->belongsToMany('App\Motor','compatibilities','Kode_Sparepart','Id_Motor');
    }

    public function detail_spareparts()
    {
        return $this->hasMany('App\Detail_Sparepart','Id_Detail_Sparepart');
    }
    public function ruangs()
    {
        return $this->belongsTo('App\Ruang','Id_Ruang');
    }

    public function compatibilities()
    {
        return $this->hasMany('App\CompatibilitiesJason','Kode_Sparepart');
    }
    
}
