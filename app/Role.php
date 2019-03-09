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

    public function pegawais()
    {
        return $this->hasMany('App\Pegawai');
    }
}
