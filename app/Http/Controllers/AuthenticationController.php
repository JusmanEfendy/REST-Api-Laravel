<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login (request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email Belum terdaftar.'],
            ]);
        }

        return $user->createToken($request->username)->plainTextToken;
    }

    public function logout(request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Token Berhasil dihapus'], Response::HTTP_OK);
    }

    public function getData()
    {
        return response()->json(Auth::user());
    }

}
