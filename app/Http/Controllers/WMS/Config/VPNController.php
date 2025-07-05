<?php

namespace App\Http\Controllers\WMS\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VPNController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Cache::rememberForever('vpn_metadata', function () {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') .'/config/vpn');
                if ($response->ok()) {
                    return $response->json('metadata');
                }
                return [];
            });

            return view('wms.config.vpn._data_vpn', compact('data'));
        }

        return view('wms.config.vpn.index', [
            'title' => 'WMS Config VPN'
        ]);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'username'  => 'required',
            'password'  => 'required'
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/vpn/store', $validator->validate());
            if($response->created()) {
                Cache::forget('vpn_metadata');
                return $this->success($response->json('metadata'), 'Akun VPN berhasil dibuat', 201);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat membuat akun VPN ' . $th->getMessage());
            return $this->error('Error', 'Silakan hubungi Administrator');
        }
    }

    public function delete($id)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
