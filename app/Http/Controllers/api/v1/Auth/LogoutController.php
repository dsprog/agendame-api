<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        if ($user && $user->currentAccessToken()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $user->currentAccessToken()->delete();

            return response()->json(['message' => 'Logged out successfully'], 200);
        }

        return response()->json(['message' => 'No active token found'], 404);
    }
}
