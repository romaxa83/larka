<?php

use App\Models\User\Role;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    public $roles = [
        Role::ADMIN_ALIAS => Role::ADMIN,
        Role::MANAGER_ALIAS => Role::MANAGER,
        Role::USER_ALIAS => Role::USER,
    ];

    public function run()
    {
        foreach ($this->roles as $key => $item){
            if(!$this->checkRoleExist($key)){

                $role = new Role();
                $role->role = $item;
                $role->alias = $key;

                $role->save();
            }
        }
    }

    private function checkRoleExist($aliasRole)
    {
        return Role::query()
            ->where('alias', $aliasRole)
            ->exists();
    }
}
