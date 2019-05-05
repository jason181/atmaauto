<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    //
    use SoftDeletes;
    protected $table = 'pegawais';
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

    public function pegawai_on_duties()
    {
        return $this->hasMany('App\Pegawai_On_Duty','Id_Duty');
    }
    
    public function montirs()
    {
        return $this->hasMany('App\Montir','Id_Jasa_Montir');
    }

    public function cabangs()
    {
        return $this->belongsTo('App\Cabang','Id_Cabang');
    }

    public function roles()
    {
        return $this->belongsTo('App\Role','Id_Role');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token','Id_Token');
    }
}
