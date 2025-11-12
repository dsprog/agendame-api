<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Exceptions\InvalidPasswordResetTokenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Auth\ResetPasswordRequest;
use App\Models\PasswordResetToken;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        // Logic to handle reset password (e.g., verify token, update password)
        $dataExpiry = now()->subHours(24)->toDateTimeString();
        $tokenRecord = PasswordResetToken::whereToken($data['token'])
            ->where('created_at', '>=', $dataExpiry)
            ->first();

        if (! $tokenRecord) {
            throw new InvalidPasswordResetTokenException;
        }

        // Assuming User model has a method to reset password
        $user = $tokenRecord->user;
        $user->password = $data['password'];
        $user->save();

        $user->resetPasswordTokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Your password has been reset successfully.',
        ], 200);
    }
}
