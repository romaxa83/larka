<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $role
 * @property string $alias
 */

class Role extends Model
{
    public $timestamps = false;

    const ADMIN = 'Администратор';
    const MANAGER = 'Менеджер';
    const USER = 'Пользователь';

    const ADMIN_ALIAS = 'admin';
    const MANAGER_ALIAS = 'manager';
    const USER_ALIAS = 'user';

    protected $table = 'user_roles';

    public function users()
    {
        return $this->belongsToMany( User::class);
    }
}
