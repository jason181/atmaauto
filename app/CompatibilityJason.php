<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompatibilityJason extends Model
{
    //
    use SoftDeletes;
    protected $table = 'compatibilities';
    protected $primaryKey = 'Id_Compatibility';
    public $timestamp = true;
    protected $fillable = [
        'Id_Motor',
        'Kode_Sparepart'
    ];

    public function spareparts()
    {
        return $this->belongsTo('App\Sparepart','Kode_Sparepart');
    }

    public function motors()
    {
        return $this->belongsTo('App\Sparepart','Id_Motor');
    }
}

