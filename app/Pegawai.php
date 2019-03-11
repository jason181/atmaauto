<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $table = 'Pegawai';
    protected $primaryKey = 'Id_Pegawai';
    public $timestamp = true;
    protected $fillable = [
        'Id_Role',
        'Id_Cabang',
        'Nama_Pegawai',
        'Alamat_Pegawai',
        'Telepon_Pegawai',
        'Gaji_Pegawai',
        'Username', 
        'Password'
    ];

    public function duties()
    {
        return $this->hasMany('App\Duty');
    }
    
    public function montirs()
    {
        return $this->hasMany('App\Montir');
    }

    public function cabangs()
    {
        return $this->belongsTo('App\Cabang');
    }

    public function roles()
    {
        return $this->belongsTo('App\Role');
    }
}
