<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($credentials->fails()) {
            return $this->error('Unprocessable Entity', $credentials->errors(), 422);
        }

        try {
            $response = Http::post(config('app.api_service') . '/login', $credentials->validate());
            if ($response->ok()) {
                $data = $response->json('metadata');
                session([
                    'api_token' => $data['token'],
                    'user_data' => $data['user'],
                    'user_pin' => $data['pin'],
                ]);

                return $this->success('', 'Berhasil login, Anda akan diarahkan...');
            }
            return $this->error('Email atau password Anda salah', 500);
        } catch (\Throwable $th) {
            Log::error('Error pada saat login ' . $th->getMessage());
            return $this->error('Internal Server Error');
        }
    }

    public function logout(Request $request)
    {
        session()->forget(['api_token', 'user_data']);
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/');
    }
}
