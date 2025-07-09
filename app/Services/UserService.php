<?php

namespace App\Services;

use App\Models\User;
use Exception;

class UserService
{
    public function verifyIfEmailExists(string $email): bool
    {
        try {
            return User::where('email', $email)->exists();
        } catch (Exception $e) {
            return false;
        }
    }

    public function findUserById($id)
    {
        return User::findOrFail($id);
    }

    public function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
