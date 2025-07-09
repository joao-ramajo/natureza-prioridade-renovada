<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Services\Operations;

class Service
{
    protected function handleCriticalException(\Exception $e, string $description)
    {
        Log::channel('npr')->error($description, ['exception' => $e->getMessage()]);
        Operations::sendEmailError($e->getMessage());
    }
}
