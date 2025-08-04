<?php

namespace App\Services;

use App\Mail\SystemErrorNotification;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Operations
{
    public static function decryptId(string $id): int | String | Null
    {
        try {
            return Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return null;
        }
    }

    public static function sendEmailError(string $exception_message): void
    {
        try {
            Mail::to(config('RESP_EMAIL', 'responsavel@gmail.com'))->send(new SystemErrorNotification($exception_message));
        } catch (\Exception $e) {
            Log::channel('npr')->error('Erro ao enviar e-mail de erro crítico.', [
                'exception' => $e->getMessage()
            ]);
        }
    }
}
