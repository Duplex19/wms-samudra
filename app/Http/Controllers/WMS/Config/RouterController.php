<?php

namespace App\Http\Controllers\WMS\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RouterController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Cache::rememberForever('router_metadata', function () {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/config/router');
                if ($response->ok()) {
                    return $response->json('metadata');
                }
                return [];
            });
            return view('wms.router._data_router', compact('data'));
        }

        return view('wms.router.index', [
            'title' => 'WMS Router'
        ]);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'ip'  => 'required',
            'username'  => 'required',
            'password'  => 'required',
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/router/store', $validator->validate());
            if($response->created()) {
                Cache::forget('router_metadata');
                return $this->success('', 'Router berhasil ditambahkan', 201);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat menambahkan router ' . $th->getMessage());
            return $this->error('Silakan hubungi Administrator', 500);
        }
    }

    public function update(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'ip'  => 'required',
        ]);

        $data = [
            'name'  => $request->name,
            'ip'  => $request->ip,
            'username'  => $request->username,
            'password'  => $request->password,
        ];

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/router/update/' . $id, $data);
            if($response->successful()) {
                Cache::forget('router_metadata');
                return $this->success('', 'Router berhasil diupdate', 201);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat update router ' . $th->getMessage());
            return $this->error('Silakan hubungi Administrator', 500);
        }
    }

    public function delete($id)
    {
        try {
            $response = Http::withToken(session('api_token'))->delete(config('app.api_service') . '/config/router/destroy/' . $id);
            if($response->successful()) {
                Cache::forget('router_metadata');
                return $this->success('','Router berhasil dihapus', 200);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat menambahkan router ' . $th->getMessage());
            return $this->error('Silakan hubungi Administrator', 500);
        }
    }

    public function ping($id)
    {
        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/router/cek_koneksi', ['id' => $id]);
            if($response->successful()) {
                Cache::forget('router_metadata');
                return $this->success('','Router berhasil terhubung', 200);
            }else {
                Cache::forget('router_metadata');
                return $this->error('Router gagal terhubung', 500);
            }
        } catch (\Throwable $th) {
            Cache::forget('router_metadata');
            Log::error('Gagal saat menghungungkan router ' . $th->getMessage());
            return $this->error('Silakan hubungi Administrator', 500);
        }
    }
}
