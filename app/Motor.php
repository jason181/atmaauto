<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motor extends Model
{
    //
    use SoftDeletes;
    protected $table = 'motors';
    protected $primaryKey = 'Id_Motor';
    public $timestamp = true;
    protected $fillable = [
        'Merk',
        'Tipe',
    ];

    public function motor_konsumens()
    {
        return $this->hasMany('App\Motor_Konsumen','Id_Motor_Konsumen');
    }

    // public function spareparts()
    // {
    //     return $this->belongsTo('App\Sparepart','Id_Sparepart');
    // }
}
