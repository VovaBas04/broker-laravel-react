<?php

namespace App\Jobs;

use App\Events\DateUpdated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class SendSchedullerDateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Carbon $date)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DateUpdated::dispatch($this->date);
    }
}
