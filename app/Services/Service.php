<?php

namespace App\Services;

use App\Jobs\SystemErrorNotificationJob;
use Illuminate\Support\Facades\Log;
use App\Services\Operations;

class Service
{
    protected function handleCriticalException(\Exception $e, string $description): void
    {
        Log::channel('npr')->error($description, ['exception' => $e->getMessage()]);
        SystemErrorNotificationJob::dispatch($e->getMessage());
    }
}
