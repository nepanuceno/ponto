<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($id);
    public function createUser($request, array $UserDetails);
    public function updateUser(array $data, $id);
    public function deleteUser($id);
    public function showUser($id);
    public function getFulfilledUsers();
}
