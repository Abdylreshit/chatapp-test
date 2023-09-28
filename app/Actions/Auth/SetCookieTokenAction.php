<?php

namespace App\Actions\Auth;

class SetCookieTokenAction
{
    public function run($responseData)
    {
        $user = auth()->user();

        $token = app(CreateTokenAction::class)->run($user, $responseData);

        setcookie("accessToken", $token->accessToken, $token->accessTokenEndTime);
        setcookie("refreshToken", $token->refreshToken, $token->refreshTokenEndTime);
        setcookie("email", $user->email, $token->refreshTokenEndTime);
    }
}
