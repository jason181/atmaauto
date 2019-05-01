<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

use JWTAuth;

class Token extends Model
{
    use SoftDeletes;

    protected $table = 'token';
    protected $primaryKey = 'Id_Token';
    public $timestamps = true;
    protected $fillable = [
        'Id_Pegawai',
        'Token_Username',
        'Token_Password',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
    protected $hidden = [
        'Id_Pegawai'
    ];
    
    public function pegawais()
    {
        return $this->belongsTo('App\Pegawai','Id_Pegawai');
    }
}
