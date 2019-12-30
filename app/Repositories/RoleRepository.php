<?php

namespace App\Repositories;

use App\Models\User\Role;

class RoleRepository
{
    public function getRolesForSelect()
    {
        return Role::query()->pluck('role', 'id');
    }

}