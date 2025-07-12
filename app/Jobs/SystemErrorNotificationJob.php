<?php

namespace App\Jobs;

use App\Services\Operations;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SystemErrorNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $exception_message
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Operations::sendEmailError($this->exception_message);
    }
}
