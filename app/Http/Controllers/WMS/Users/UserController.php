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
            if($request->category == 'team') {
                $response =  Http::withToken(session('api_token'))->get(config('app.api_service') .'/admin/team');
                return $this->success($response->json('metadata'), 'List data team', 200);
            }else {
                $data = Cache::remember('users_metadata', now()->addMinute(), function () {
                    $response = Http::withToken(session('api_token'))->get(config('app.api_service') .'/admin/users');
                    if ($response->ok()) {
                        return $response->json('metadata');
                    }
                    return [];
                });
            }

            return view('wms.users._data_user', ['users' => $data]);
        }
       return view('wms.users.index');
    }

    public function update(Request $request, $id) 
    {

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "role" => "required",
            "whatsapp" => "required",
            "jabatan" => "required",
            "foto"  => 'image|max:2048|mimes:jpg,jpeg,png',
            "nama_team" => "required",
            "bank_code" => "required",
            "norek" => "required",
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        $data = $validator->validate();
        $data['team_management_id'] = $request->team_management_id ?? null;
        $data['password'] = $request->password ?? '';
        
        try {
            $requestHttp = Http::withToken(session('api_token'));

            if ($request->hasFile('foto')) {
                $requestHttp = $requestHttp->attach(
                    'foto',
                    fopen($request->file('foto')->getRealPath(), 'r'),
                    $request->file('foto')->getClientOriginalName()
                );
            }

            $response = $requestHttp->post(config('app.api_service') . '/admin/users/update/' . $id, $data);

            // $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/admin/users/update/' . $id,  $data);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
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
