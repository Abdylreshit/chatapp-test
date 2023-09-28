<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\SetCookieTokenAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Managers\ChatAppClient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $responseData = app(ChatAppClient::class)->login($request->email, $request->password);

        $user = User::query()
            ->firstOrCreate(['email' => $request->email],['password' => Hash::make($request->password)]);

        auth()->login($user);

        app(SetCookieTokenAction::class)->run($responseData);
        
        return redirect('/');
    }
}
