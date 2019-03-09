<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    //
    protected $table = 'Motor';
    protected $primaryKey = 'Id_Motor';
    public $timestamp = true;
    protected $fillable = [
        'Id_Motor',
        'Merk',
        'Tipe',
        'Kode_Sparepart'
    ];

    public function motor_konsumens()
    {
        return $this->hasMany('App\Motor_Konsumen');
    }

    public function spareparts()
    {
        return $this->belongsTo('App\Sparepart');
    }
}
