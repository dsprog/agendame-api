<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Exceptions\InvalidTokenException;
use App\Exceptions\UserAlreadyVerifiedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Auth\VerifyEmailRequest;
use App\Http\Resources\UserResource;
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

        if (! $user) {
            throw new InvalidTokenException;
        }

        if ($user->email_verified_at) {
            throw new UserAlreadyVerifiedException;
        }

        $user->email_verified_at = now();
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully!',
            'user' => new UserResource($user),
        ], 200);
    }
}
