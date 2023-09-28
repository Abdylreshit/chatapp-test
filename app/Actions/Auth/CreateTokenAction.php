<?php

namespace App\Actions\Auth;

class CreateTokenAction
{
    public function run($user, $responseData)
    {
        return $user->tokens()->create($responseData['data']);
    }
}
