<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $table = 'pegawais';
    protected $primaryKey = 'Id_Pegawai';
    public $timestamp = true;
    protected $fillable = [
        'Id_Role',
        'Id_Cabang',
        'Nama_Pegawai',
        'Alamat',
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
        return $this->belongsTo('App\Cabang','Id_Cabang');
    }

    public function roles()
    {
        return $this->belongsTo('App\Role','Id_Role');
    }
}
