<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Role;

class RoleTransformers extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Role $role)
    {
        return [
            'id'                    => $role->Id_Role,
            'Nama_Role'           => $role->Nama_Role,
            
        ];
    }
}