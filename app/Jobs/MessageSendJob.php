<?php

namespace App\Jobs;

use App\Actions\MessageSendAction;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MessageSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $message;
    private $accessToken;

    /**
     * Create a new job instance.
     */
    public function __construct(Message $message, $accessToken)
    {
        $this->message = $message;
        $this->accessToken = $accessToken;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        app(MessageSendAction::class)->run($this->message, $this->accessToken);
    }
}
