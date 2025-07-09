<?php

namespace App\Services;

use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Operations
{
    public static function decryptId($id)
    {
        try {
            throw new Exception('aoksd');
            return Crypt::decrypt($id);
        } catch (Exception $e) {
            return null;
        }
    }
}
