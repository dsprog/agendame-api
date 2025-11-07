<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Auth\VerifyEmailRequest;
use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyEmailRequest $request)
    {
        $data = $request->validated();
        $token = $data['token'];

        $user = User::where('token', $token)->first();

        if ($user) {

            $user->email_verified_at = now();
            $user->token = null; // Invalidate the token after verification
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Email verified successfully!',
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Invalid or expired token.',
            ], 400);
        }
    }
}
