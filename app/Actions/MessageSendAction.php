<?php

namespace App\Actions;

use App\Managers\ChatAppClient;
use App\Models\Messenger;
use Throwable;

class MessageSendAction
{
    public function run($message, $accessToken)
    {
        try{
            app(ChatAppClient::class)->messageSend($message, $accessToken);
        }catch(Throwable $th){
            info($th);
            $message->update(['status' => false]);
            return;
        }

        info('ez');
        $message->update(['status' => true]);   
    }
}
