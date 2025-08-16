<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\Auth\RegisterController;
use App\Http\Controllers\api\v1\Auth\LoginController;
use App\Http\Controllers\api\v1\Auth\LogoutController;

Route::prefix('v1')->group(function () {

    Route::post('/register', RegisterController::class);
    Route::post('login', LoginController::class);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', LogoutController::class);
        Route::get('user', function (Request $request) {
            return $request->user();
        });
    });

    Route::get('/test', function (Request $request) {
        return response()->json(['success' => true], 200);
    });
});
