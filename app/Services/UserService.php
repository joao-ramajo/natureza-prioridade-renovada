<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;


class UserService extends Service
{
    public function verifyIfEmailExists(string $email): bool | null
    {
        try {

            return User::where('email', $email)->exists();
        } catch (QueryException $e) {
            $this->handleCriticalException($e, 'Erro no banco de dados');
            return null;
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao verificar se o email já está cadastrado', ['exception' => $e->getMessage()]);
            return null;
        }
    }

    public function findUserById(int|string $id): ?User
    {
        try {
            return User::findOrFail($id);
        } catch (QueryException $e) {
            $this->handleCriticalException($e, 'Erro no banco de dados');
            return null;
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao buscar usuário pelo ID', ['exception' => $e->getMessage()]);
            return null;
        }
    }

    public function findUserByEmail(string $email): ?User
    {
        try {
            return User::where('email', $email)->first();
        } catch (QueryException $e) {
            $this->handleCriticalException($e, 'Erro no banco de dados');
            return null;
        } catch (Exception $e) {
            Log::channel('npr')->error('Erro ao buscar usuário por email', ['exception' => $e->getMessage()]);
            return null;
        }
    }
}
