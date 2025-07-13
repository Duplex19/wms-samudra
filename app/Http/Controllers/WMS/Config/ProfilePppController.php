<?php

namespace App\Http\Controllers\WMS\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ProfilePppController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Cache::rememberForever('profileppp_metadata', function () {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/config/profile');
                if ($response->ok()) {
                    return $response->json('metadata');
                }
                return [];
            });
           return DataTables::of($data)
            ->rawColumns(['action', 'status'])
            ->make(true);
        }

        return view('wms.config.profileppp.index', [
            'title' => 'WMS Router'
        ]);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'group'  => 'required',
            'price'  => 'required',
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        $data = $validator->validate();
        $data['price'] = str_replace('.', '',$request->price);

        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/profile/store', $data);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if($response->created()) {
                Cache::forget('profileppp_metadata');
                return $this->success('', 'Profil PPP berhasil ditambahkan', 201);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat menambahkan Profil PPP ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }

    public function update(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'group'  => 'required',
            'price'  => 'required',
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        $data = $validator->validate();
        $data['price'] = str_replace('.', '',$request->price);
        
        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/profile/update/' . $id, $data);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if($response->successful()) {
                Cache::forget('profileppp_metadata');
                return $this->success('', 'Profil PPP berhasil diupdate', 201);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat update Profil PPP ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $response = Http::withToken(session('api_token'))->delete(config('app.api_service') . '/config/profile/destroy/' . $id);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if($response->successful()) {
                Cache::forget('profileppp_metadata');
                return $this->success('','Profil PPP berhasil dihapus', 200);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat menambahkan Profil PPP ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }
}
