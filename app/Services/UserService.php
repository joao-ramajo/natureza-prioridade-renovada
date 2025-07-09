<?php

namespace App\Services;

use App\Mail\SystemErrorNotification;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            DB::table('users')->insert([
                'name' => 'Teste',
                'email' => 'teste@email.com',
                'password' => bcrypt('senha'),
                'id' => 'string_invalida', // se `id` for auto-increment e inteiro
            ]);
            return User::findOrFail($id);
        } catch (QueryException $e) {
            Log::channel('npr')->error('Erro ao consultar banco de dados', ['exception' => $e->getMessage()]);
            Operations::sendEmailError($e->getMessage());
            return null;
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
