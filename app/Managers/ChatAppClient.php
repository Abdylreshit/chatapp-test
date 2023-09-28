<?php

namespace App\Managers;

use Illuminate\Support\Facades\Http;

class ChatAppClient
{
    private string $baseUrl;
    private string $appId;

    public $request;

    public function __construct()
    {
        $this->baseUrl = "https://api.chatapp.online";
        $this->appId = "webchat";
    }

    public function login($email, $password)
    {
        $url = "{$this->baseUrl}/v1/tokens";

        $data = [
            'email' => $email,
            'password' => $password,
            'appId' => $this->appId,
        ];

        $request = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->timeout(60)
        ->post($url, $data);

        $response = json_decode($request->body(), true);

        if ($response['success'] == false){
            abort(500);
        }

        return $response;
    }

    public function refresh($refreshToken)
    {
        $url = "{$this->baseUrl}/v1/tokens/refresh";

        $request = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Refresh' => $refreshToken,
        ])
        ->timeout(60)
        ->post($url);

        $response = json_decode($request->body(), true);

        if ($response['success'] == false){
            abort(500);
        }

        return $response;
    }

    public function licenses($accessToken)
    {
        $url = "{$this->baseUrl}/v1/licenses";

        $request = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $accessToken,
        ])
        ->timeout(60)
        ->get($url);

        $response = json_decode($request->body(), true);

        if ($response['success'] == false){
            abort(500);
        }

        return $response;
    }

    public function messageSend($message, $accessToken)
    {
        $url = "{$this->baseUrl}/v1/licenses/{$message->license->licenseId}/messengers/{$message->messenger->type}/chats/{$message->phone}/messages/text";
        
        dd($url);

        $data = [
            'text' => $message->text
        ];

        $request = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $accessToken,
        ])
        ->timeout(60)
        ->post($url, $data);

        $response = json_decode($request->body(), true);

        if ($response['success'] == false){
            abort(500);
        }

        return $response;
    }
}
