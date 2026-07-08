<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessCampaignBatch implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private array $emails,
        private string $subject,
        private string $body,
        private string $campaignId
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->emails as $email) {
            Log::info('E-mail enviado', [
                'email' => $email,
                'subject' => $this->subject,
                'body' => $this->body,
                'campaign_id' => $this->campaignId
            ]);
        }
    }
}
