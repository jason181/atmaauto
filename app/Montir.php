<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Montir extends Model
{
    //
    use SoftDeletes;
    protected $table = 'montirs';
    protected $primaryKey = 'Id_Jasa_Montir';
    public $timestamp = true;
    protected $fillable = [
        'Id_Pegawai',
        'Id_Motor_Konsumen'
    ];

    public function pegawais()
    {
        return $this->belongsTo('App\Pegawai','Id_Pegawai');
    }

    public function motor_konsumens()
    {
        return $this->belongsTo('App\Motor_Konsumen','Id_Motor_Konsumen');
    }

    public function detail_spareparts()
    {
        return $this->hasMany('App\Detail_Sparepart','Id_Detail_Sparepart');
    }

    public function detail_jasas()
    {
        return $this->hasMany('App\Detail_Jasa','Id_Detail_Jasa');
    }
}
