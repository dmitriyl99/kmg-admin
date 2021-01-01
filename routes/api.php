<?php

use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\ContainerController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);

    Route::get('app', [AppController::class, 'index']);

    Route::prefix('containers')->group(function () {
        Route::get('statuses', [ContainerController::class, 'statuses']);

        Route::get('', [ContainerController::class, 'index']);
        Route::post('', [ContainerController::class, 'store']);
        Route::get('{id}', [ContainerController::class, 'show']);
        Route::post('{id}/update', [ContainerController::class, 'update']);
        Route::delete('{id}', [ContainerController::class, 'destroy']);
    });

    Route::prefix('cargos')->group(function () {
        Route::get('', [CargoController::class, 'index']);
        Route::post('', [CargoController::class, 'store']);
        Route::get('{id}', [CargoController::class, 'show']);
        Route::post('{id}/update', [CargoController::class, 'update']);
        Route::delete('{id}', [CargoController::class, 'destroy']);
    });
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
});
