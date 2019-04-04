<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Pegawai;

class PegawaiTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Pegawai $pegawai)
    {
        return [
            'Id_Role'              => $pegawai->Id_Role,
            'Id_Cabang'            => $pegawai->Id_Cabang,
            'id'                   => $pegawai->Id_Pegawai,
            'Nama_Pegawai'         => $pegawai->Nama_Pegawai,
            'Alamat'       => $pegawai->Alamat,
            'Telepon_Pegawai'      => $pegawai->Telepon_Pegawai,
            'Gaji_Pegawai'         => $pegawai->Gaji_Pegawai,
            'Username'             => $pegawai->Username,
            'Password'             => $pegawai->Password        
        ];
    }
}