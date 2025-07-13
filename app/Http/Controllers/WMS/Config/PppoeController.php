<?php

namespace App\Http\Controllers\WMS\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class PppoeController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            switch ($request->data) {
                case 'router':
                    $data = Cache::rememberForever('router_metadata', function () {
                        $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/config/router');
                        if ($response->ok()) {
                            return $response->json('metadata');
                        }
                        return [];
                    });
                    return $this->success($data, 'List data router');
                    break;
                case 'profile_ppp':
                    $data = Cache::rememberForever('profileppp_metadata', function () {
                        $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/config/profile');
                        if ($response->ok()) {
                            return $response->json('metadata');
                        }
                        return [];
                    });
                    return $this->success($data, 'List data profile ppp');
                    break;
                default:
                try {
                    $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/config/pppoe');
                    if ($response->status() === 401) {
                        session()->forget(['api_token', 'user_data']);
                        $request->session()->invalidate();
                        $request->session()->regenerate();
                        return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
                    }
                    $pppoe = $response->json('metadata');

                    // Lakukan filter manual jika request mengandung status
                    if ($request->has('status') && $request->status !== null) {
                        $filtered = collect($pppoe);
                        $pppoe = $filtered->where('status', $request->status);
                    }

                    return DataTables::of($pppoe)    
                    ->rawColumns(['action', 'status'])
                    ->make(true);
                } catch (\Throwable $th) {
                    Log::error('Gagal saat mengambil data pppoe ' . $th->getMessage(), 500);
                    return $this->error('Internal server error. Silakan hubungi Administrator', 500);
                }
                    
                break;
            }
        }

        return view('wms.config.pppoe.index', [
            'title' => 'WMS Router'
        ]);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            "router_id" => "required",
            "profile_ppp_id" => "required",
            "username" => "required",
            "password" => "required",
            "name" => "required",
            "whatsapp" => "required",
            "address" => "required",
            "active_date" => "required",
            "payment_type" => "required|in:postpaid,prepaid",
            "status" => "required|in:active,inactive"
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        $data = $validator->validate();
        $data['active_date'] = Carbon::parse($request->active_date)->format('Y-m-d');

        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/pppoe/store', $data);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if($response->created()) {
                Cache::forget('pppoe_metadata');
                return $this->success('', 'Pppoe berhasil ditambahkan', 201);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat menambahkan Pppoe ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }

    public function update(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            "router_id" => "required",
            "profile_ppp_id" => "required",
            "username" => "required",
            "password" => "required"
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/pppoe/update/' . $id,  $validator->validate());
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if($response->successful()) {
                Cache::forget('pppoe_metadata');
                return $this->success('', 'Pppoe berhasil diupdate', 200);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat update Pppoe ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }

    public function setStatus(Request $request, $id)
    {
       try {
        $status = $request->status == 'active' ? 'suspend' : 'active';
        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/pppoe/set_status/' . $id, ['status' => $status]);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if($response->successful()) {
                Cache::forget('pppoe_metadata');
                return $this->success('', 'Status pppoe berhasil diupdate', 200);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat update status pppoe ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
       } catch (\Throwable $th) {
             Log::error('Gagal saat update Pppoe ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
       }
    }


    public function delete(Request $request, $id)
    {
        try {
            $response = Http::withToken(session('api_token'))->delete(config('app.api_service') . '/config/pppoe/destroy/' . $id);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if($response->successful()) {
                Cache::forget('pppoe_metadata');
                return $this->success('','Pppoe berhasil dihapus', 200);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat menghapus Pppoe ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }
}
