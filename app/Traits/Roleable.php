<?php

namespace App\Traits;

use App\Models\User\Role;

trait Roleable
{
    //relation
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_role_pivot', 'user_id', 'role_id');
    }

    public function setRole($role)
    {
        $role = Role::where(['alias' => $role])->first();
        $this->attachRoles($role->id);
    }

    public function attachRoles($roleId)
    {
        $this->roles()->attach($roleId);
    }

    public function detachRoles()
    {
        $this->roles()->detach($this->getRolesId());
    }

    public function getRolesString()
    {
        return $this->roles()->pluck('role')->implode(',');
    }

    public function getRolesId()
    {
        return $this->roles()->pluck('id');
    }

    public function hasRoleByName($roleName)
    {
        return $this->roles()->where('role', $roleName)->exists();
    }
}
