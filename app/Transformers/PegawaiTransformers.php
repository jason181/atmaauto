<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Pegawai;
use App\Role;

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
            'Id_Role'               => $pegawai->Id_Role,
            'Nama_Role'             => $pegawai->roles->Nama_Role,
            'Id_Cabang'             => $pegawai->Id_Cabang,
            'Nama_Cabang'           => $pegawai->cabangs->Nama_Cabang,
            'Id_Pegawai'            => $pegawai->Id_Pegawai,
            'Nama_Pegawai'          => $pegawai->Nama_Pegawai,
            'Alamat_Pegawai'        => $pegawai->Alamat_Pegawai,
            'Telepon_Pegawai'       => $pegawai->Telepon_Pegawai,
            'Gaji_Pegawai'          => $pegawai->Gaji_Pegawai,
            'Username'              => $pegawai->Username,
            'Password'              => $pegawai->Password        
        ];
    }
}