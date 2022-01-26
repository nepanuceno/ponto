<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface {

    public function getAllRoles($num_paginate=false);
    public function createRole($input_name, $input_permission);
    public function getRole($roleId);
    public function editRole($role);
    public function deleteRole($roleId);
    public function syncPermission($input, $role);
}
