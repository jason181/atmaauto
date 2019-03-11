<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    //
    protected $table = 'jasas';
    protected $primaryKey = 'Id_Jasa';
    public $timestamp = true;
    protected $fillable = [
        'Nama_Jasa',
        'Harga_Jasa'
    ];

    public function detail_jasas()
    {
        return $this->hasMany('App\Detail_Jasa');
    }
}
