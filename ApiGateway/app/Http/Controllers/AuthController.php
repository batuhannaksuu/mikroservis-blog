<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $data = $request->only(['name', 'email','password']);
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $token = $user->createToken('accessToken')->accessToken;

        return response()->json([
            'success' => true,
            'message' => 'Kullanıcı başarıyla oluşturuldu.',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Geçersiz e-posta veya şifre.'],
            ]);
        }

        $token = $user->createToken('accessToken')->accessToken;

        return response()->json([
            'success' => true,
            'message' => 'Başarıyla giriş yapıldı.',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 200);
    }
}
