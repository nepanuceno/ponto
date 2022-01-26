<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::orderBy('id','DESC')->paginate(5);
    }

    public function getUserById($UserId)
    {
        return User::findOrFail($UserId);
    }

    public function deleteUser($UserId)
    {
        $user = User::find($UserId);
        $user_name = $user->name;
        $user->delete();

        return $user_name;
    }

    public function createUser($request, array $UserDetails)
    {
        $user = User::create($UserDetails);
        $user->assignRole($request->input('roles'));
        return $user;
    }

    public function showUser($UserId)
    {
        return User::find($UserId);
    }

    public function updateUser(array $newDetails, $UserId)
    {
        $user = $this->getUserById($UserId);
        return $user->update($newDetails);

    }

    public function getFulfilledUsers()
    {
        return User::where('is_fulfilled', true);
    }
}
