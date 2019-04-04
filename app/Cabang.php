<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    //
    protected $table = 'cabangs';
    protected $primaryKey = 'Id_Cabang';
    public $timestamp = true;
    protected $fillable = [
        'Nama_Cabang',
        'Alamat_Cabang',
        'Telepon_Cabang'
    ];

    public function pegawais()
    {
        return $this->hasMany('App\Pegawai','Id_Cabang');
    }
}
