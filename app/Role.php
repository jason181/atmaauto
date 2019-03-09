<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'Role';
    protected $primaryKey = 'Id_Role';
    public $timestamp = true;
    protected $fillable = [
        'Nama_Role'
    ];

    public function cabangs()
    {
        return $this->hasMany('App\Pegawai');
    }
}
