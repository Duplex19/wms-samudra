<?php

namespace App\Http\Controllers\WMS\Pin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PinController extends Controller
{
    public function setPin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "pin" => "required|max:6",
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/pins', [
                'key_name'  => 'blast_sallary',
                'pin'   =>  implode('', $request->pin)

            ]);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            Log::info('Berhasil set PIN ' . $request->key_name . '-' . session('user_data.name'));
            session()->put('user_pin.blast_sallary', true);
            return $this->success('','PIN Anda berhasil disimpan');
        } catch (\Throwable $th) {
            Log::error('Data anggota gagal diupdate ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }
}
