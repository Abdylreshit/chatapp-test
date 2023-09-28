<?php

namespace App\Http\Controllers;

use App\Actions\CreateLicensesAction;
use App\Managers\ChatAppClient;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $responseData = app(ChatAppClient::class)->licenses($request->cookie('accessToken'));

        app(CreateLicensesAction::class)->run($responseData);

        $user = auth()->user();

        $licenses = $user->licenses;

        $messengers = $user->messengers;

        $messages = $user->messages()->with('messenger')->orderByDesc('id')->paginate(10);

        return view('index', compact('licenses', 'messengers', 'messages'));
    }
}
