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
            'Role'                  => $pegawai->roles->Nama_Role,
            'Cabang'                => $pegawai->cabangs->Nama_Cabang,
            'Id_Pegawai'            => $pegawai->Id_Pegawai,
            'Nama_Pegawai'          => $pegawai->Nama_Pegawai,
            'Alamat_Pegawai'        => $pegawai->Alamat,
            'Telepon_Pegawai'       => $pegawai->Telepon_Pegawai,
            'Gaji_Pegawai'          => $pegawai->Gaji_Pegawai,
            'Username'              => $pegawai->Username,
            'Password'              => $pegawai->Password        
        ];
    }
}