<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    const owner    = 1;
    const cs       = 2;
    const kasir    = 3;

    protected $table = 'roles';
    protected $primaryKey = 'Id_Role';
    public $timestamp = true;
    protected $fillable = [
        'Nama_Role'
    ];

    public function pegawais()
    {
        return $this->hasMany('App\Pegawai','Id_Role');
    }
}
