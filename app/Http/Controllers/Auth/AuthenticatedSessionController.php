<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $token = $request->user()->createToken('API Token')->plainTextToken;

        // UPDATE:
        // Instead of returning the token as 'cookie' like the one below:

        // return response()->cookie('token', $token, 60);

        // And change the return type for this function as 'JsonResponse'
        // instead of 'Response'.

        // You could return the token as JSON like this:
        return response()->json(['token' => $token]);
        // This would prevent a 'minor' login issue (but you can still continue to the dashboard).

        // return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
