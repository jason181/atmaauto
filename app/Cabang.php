<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cabang extends Model
{
    //
    use SoftDeletes;
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

//cek