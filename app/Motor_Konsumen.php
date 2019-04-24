<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motor_Konsumen extends Model
{
    //
    protected $table = 'motor_konsumens';
    protected $primaryKey = 'Id_Motor_Konsumen';
    public $timestamp = true;
    protected $fillable = [
        'Id_Motor_Konsumen',
        'Id_Konsumen',
        'Id_Motor', 
        'Plat_Kendaraan'
    ];

    public function montirs()
    {
        return $this->hasMany('App\Montir','Id_Jasa_Montir');
    }

    public function konsumens()
    {
        return $this->belongsTo('App\Konsumen','Id_Konsumen');
    }

    public function motors()
    {
        return $this->belongsTo('App\Motor','Id_Motor');
    }
}
