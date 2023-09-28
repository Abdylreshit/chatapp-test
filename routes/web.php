<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckAuthToken;

use App\Http\Controllers\Auth\{
    LoginViewController,
    LoginController
};
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DistributionCreate;
use App\Http\Controllers\MessageCreate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => CheckAuthToken::class
], function(){
    Route::get('/', IndexController::class)->name('index');
    Route::post('distribution/create', DistributionCreate::class)->name('distribution.create');
    Route::post('message/create', MessageCreate::class)->name('message.create');
});

Route::get('login', LoginViewController::class)->name('login-view');
Route::post('login', LoginController::class)->name('login');