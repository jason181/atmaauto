<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jasa extends Model
{
    //
    use SoftDeletes;
    protected $table = 'jasas';
    protected $primaryKey = 'Id_Jasa';
    public $timestamp = true;
    protected $fillable = [
        'Nama_Jasa',
        'Harga_Jasa'
    ];

    public function detail_jasas()
    {
        return $this->hasMany('App\Detail_Jasa','Id_Jasa');
    }
}
