<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Auth\ForgetPasswordRequest;
use App\Models\User;
use App\Events\ForgotPasswordRequested;
use App\Exceptions\UserNotFoundException;

class ForgetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ForgetPasswordRequest $request)
    {
        $data = $request->validated();

        $user = User::whereEmail($data['email'])->first();

        if(!$user) {
            throw new UserNotFoundException();
        }

        $token = bin2hex(random_bytes(32));

        $user->resetPasswordTokens()->create([
            'token' => $token
        ]);

        ForgotPasswordRequested::dispatch($user, $token);

        return response()->json([
            'success' => true,
            'message' => 'If your email is registered, you will receive a password reset link shortly.',
        ], 200);
    }
}
