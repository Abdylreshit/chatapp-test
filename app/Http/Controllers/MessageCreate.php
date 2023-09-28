<?php

namespace App\Http\Controllers;

use App\Jobs\MessageSendJob;
use App\Models\License;
use App\Models\Message;
use App\Models\Messenger;
use Illuminate\Http\Request;

class MessageCreate extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $license = License::find($request->license_id);
        $messenger = Messenger::find($request->messenger_id);

        $message = Message::create([
            'user_id' => $user->id,
            'license_id' => $license->id,
            'messenger_id' => $messenger->id,
            'phone' => $request->phone,
            'text' => $request->text,
        ]);

        MessageSendJob::dispatch($message, $request->cookie('accessToken'));

        return redirect()->back();
    }
}
