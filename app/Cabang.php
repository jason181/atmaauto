<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    //
    protected $table = 'Cabang';
    protected $primaryKey = 'Id_Cabang';
    public $timestamp = true;
    protected $fillable = [
        'Nama_Cabang',
        'Alamat_Cabang'
    ];

    public function pegawais()
    {
        return $this->hasMany('App\Pegawai');
    }
    //test commit
    //test again
}
