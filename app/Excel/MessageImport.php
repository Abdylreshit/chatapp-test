<?php

namespace App\Excel;

use App\Jobs\MessageSendJob;
use App\Models\Message;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageImport implements OnEachRow, WithChunkReading
{
    private $user;
    private $messenger;
    private $license;
    private $accessToken;

    public function __construct($user, $messenger, $license, $accessToken)
    {
        $this->user = $user;
        $this->messenger = $messenger;
        $this->license = $license;
        $this->accessToken = $accessToken;
    }

    public function onRow(Row $row){
        $row = $row->toArray();

        if ($row[0] == 'Phone') {
            return null;
        }

        $message = Message::create([
            'user_id' => $this->user->id,
            'license_id' => $this->license->id,
            'messenger_id' => $this->messenger->id,
            'phone' => $row[0],
            'text' => $row[1],
        ]);

        $delaySecond = rand(5,50);

        info($delaySecond);

        MessageSendJob::dispatch($message, $this->accessToken)
            ->delay(now()->addSeconds($delaySecond));
    }

    public function chunkSize(): int
    {
        return 10;
    }
}