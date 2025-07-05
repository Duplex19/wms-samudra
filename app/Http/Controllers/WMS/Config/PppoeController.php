<?php

namespace App\Http\Controllers\WMS\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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
                   $data = Cache::rememberForever('pppoe_metadata', function () {
                        $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/config/pppoe');
                        if ($response->ok()) {
                            return $response->json('metadata');
                        }
                        return [];
                    });
                    return view('wms.config.pppoe._data_pppoe', compact('data'));
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
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/pppoe/update/' . $id, $data);
            if($response->successful()) {
                Cache::forget('pppoe_metadata');
                return $this->success('', 'Pppoe berhasil diupdate', 201);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat update Pppoe ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }

    public function delete($id)
    {
        try {
            $response = Http::withToken(session('api_token'))->delete(config('app.api_service') . '/config/pppoe/destroy/' . $id);
            if($response->successful()) {
                Cache::forget('pppoe_metadata');
                return $this->success('','Pppoe berhasil dihapus', 200);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat menambahkan Pppoe ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }
}
