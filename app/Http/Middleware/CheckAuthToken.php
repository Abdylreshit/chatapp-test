<?php

namespace App\Http\Middleware;

use App\Actions\Auth\RefreshAuthTokenAction;
use App\Actions\Auth\SetCookieTokenAction;
use App\Managers\ChatAppClient;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckAuthToken
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->hasCookie('accessToken')) {
            return $next($request);
        }

        if($request->hasCookie('refreshToken')) {
            $responseData = app(ChatAppClient::class)->refresh($request->cookie('refreshToken'));

            app(SetCookieTokenAction::class)->run($responseData);

            return $next($request);
        }

        return $this->redirect();
    }

    private function redirect(){
        Session::flush();
        Auth::logout();
        return redirect()->route('login-view')->withErrors(['msg' => 'server error']);
    }
}
