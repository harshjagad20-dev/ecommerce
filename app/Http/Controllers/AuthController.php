<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(SignUpRequest $request)
    {
        $user = User::create($request->validated());

        return response()->json([
            'type' => 'Bearer',
            'token' => $user->createToken($request->email)->plainTextToken
        ]);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['provided credentials are incorrect']
            ]);
        }

        return response()->json([
            'type' => 'Bearer',
            'token' => $user->createToken($request->email)->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
