<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Montir extends Model
{
    //
    protected $table = 'Montir';
    protected $primaryKey = 'Id_Jasa_Montir';
    public $timestamp = true;
    protected $fillable = [
        'Id_Pegawai',
        'Id_Motor_Konsumen'
    ];

    public function pegawais()
    {
        return $this->belongsTo('App\Pegawai');
    }

    public function motor_konsumens()
    {
        return $this->belongsTo('App\Motor_Konsumen');
    }

    public function detail_spareparts()
    {
        return $this->hasMany('App\Detail_Sparepart');
    }

    public function detail_jasas()
    {
        return $this->hasMany('App\Detail_Jasa');
    }
}
