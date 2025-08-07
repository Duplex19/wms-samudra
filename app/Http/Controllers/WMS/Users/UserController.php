<?php

namespace App\Http\Controllers\WMS\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Cache::remember('users_metadata', now()->addMinute(), function () {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') .'/admin/users');
                if ($response->ok()) {
                    return $response->json('metadata');
                }
                return [];
            });

            return view('wms.users._data_user', ['users' => $data]);
        }
       return view('wms.users.index');
    }

    public function update(Request $request, $id) 
    {

    // "id": "c5b19d20-6ae8-4231-a59c-7abc9b041cdc",
    // "name": "Robyansyah",
    // "email": "robiyansyah664@gmail.com",
    // "role": "teknisi",
    // "whatsapp": "6285832772114",
    // "jabatan": "TEKNISI",
    // "foto": "https://api.samudrawasesa.co.id/stream/user/profile/FtNB4oOnYiatgiKhhJ8wdRssckXaVcFU9Ndx1j8G.jpg",
    // "team": "Team Ian",
    // "bank": {
    //     "name": "ROBI",
    //     "bank_code": "BRI",
    //     "norek": "188301007012530"
    // }

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "role" => "required",
            "whatsapp" => "required",
            "jabatan" => "required",
            "foto"  => 'image|max:2048:mimes:jpg,jpeg,png',
            "team" => "required",
            "bank_code" => "required",
            "norek" => "required",
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        $data = $validator->validate();
        $data['team_management_id'] = $request->team_management_id ?? null;
        try {
            $response = Http::withToken(session('api_token'))->put(config('app.api_service') . '/admin/users/update/' . $id,  $data);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            dd($response->body());
            if($response->successful()) {
                Cache::forget('users_metadata');
                return $this->success('', 'Data anggota berhasil diupdate', 200);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Data user gagal diupdate ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $response = Http::withToken(session('api_token'))->delete(config('app.api_service') . '/admin/users/' . $id);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if($response->successful()) {
                Cache::forget('users_metadata');
                return $this->success('','User berhasil dihapus', 200);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat menghapus user ' . $th->getMessage());
            return $this->error('Silakan hubungi Administrator', 500);
        }
    }
}
