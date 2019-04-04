<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Role;

<<<<<<< HEAD
class RoleTransformers extends TransformerAbstract
=======
class CabangTransformers extends TransformerAbstract
>>>>>>> 693bc04d79a43a3172e40d007b45f13c8db05adf
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Role $role)
    {
        return [
<<<<<<< HEAD
            'Id_Role'           => $role->Id_Role,
            'Nama_Role'         => $role->Nama_Role,
=======
            'id'                    => $role->Id_Role,
            'Nama_Role'           => $role->Nama_Role,
            
>>>>>>> 693bc04d79a43a3172e40d007b45f13c8db05adf
        ];
    }
}