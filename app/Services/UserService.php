<?php

namespace App\Services;

use App\Models\User;
use Egulias\EmailValidator\Result\Reason\ExpectingCTEXT;
use Exception;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function verifyIfEmailExists(string $email): bool | null
    {
        try {
            return User::where('email', $email)->exists();
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao verificar se o email já está cadastrado', ['exception' => $e->getMessage()]);
            return null;
        }
    }

    public function findUserById($id): ?User
    {
        try {
            return User::findOrFail($id);
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao buscar usuário pelo ID', ['exception' => $e->getMessage()]);
            return null;
        }
    }

    public function findUserByEmail($email): ?User
    {
        try {
            return User::where('email', $email)->first();
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao buscar usuário por email', ['exception' => $e->getMessage()]);
            return null;
        }
    }
}
