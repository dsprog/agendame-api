<?php

use App\Http\Controllers\api\v1\Auth\ForgetPasswordController;
use App\Http\Controllers\api\v1\Auth\LoginController;
use App\Http\Controllers\api\v1\Auth\LogoutController;
use App\Http\Controllers\api\v1\Auth\RegisterController;
use App\Http\Controllers\api\v1\Auth\ResetPasswordController;
use App\Http\Controllers\api\v1\Auth\VerifyEmailController;
use App\Http\Controllers\api\v1\User\MeController;
use App\Http\Controllers\api\v1\User\ShowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::post('/register', RegisterController::class);
    Route::post('/login', LoginController::class);
    Route::get('/users/{user}', ShowController::class);
    Route::post('/verify-email', VerifyEmailController::class);
    Route::post('/forgot-password', ForgetPasswordController::class);
    Route::post('/reset-password', ResetPasswordController::class);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', LogoutController::class);
        Route::get('/me', MeController::class);
        Route::get('/testxx', function (Request $request) {
            return response()->json(['success' => true], 200);
        });
    });

    Route::get('/test', function (Request $request) {
        return response()->json(['success' => true], 200);
    });

    Route::post('/test-mail', function () {
        $email = \Illuminate\Support\Facades\Mail::to('test@test.com')
            ->send(new \App\Mail\WelcomeMail);

        return response()->json(['success' => true, 'message' => 'Mensagem enviada com sucesso'], 200);
    });
});
