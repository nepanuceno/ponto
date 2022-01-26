<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles($num_paginate=false) {
        return Role::orderBy('id','DESC')->paginate($num_paginate);
    }

    public function createRole($input_name, $input_permission)
    {
        $role = Role::create($input_name);
        return $role->syncPermissions($input_permission);
    }

    public function getRole($roleId)
    {
        return Role::find($roleId);
    }

    public function editRole($role)
    {
        return $role->save();
    }

    public function deleteRole($roleId)
    {
        $role = Role::find($roleId);
        $role_name = $role->name;
        $role->delete();

        return $role_name;
    }

    public function syncPermission($input, $role)
    {
        $role->syncPermissions($input);
    }
}
