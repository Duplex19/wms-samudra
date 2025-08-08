<?php

namespace App\Http\Controllers\WMS\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Client\Pool;

class SettingController extends Controller
{
    public function sechedule(Request $request)
    {
        if($request->ajax()) {
            $data = Cache::rememberForever('schedule_metadata', function () use ($request) {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/config/schedule');
                    if ($response->status() === 401) {
                    session()->forget(['api_token', 'user_data']);
                    $request->session()->invalidate();
                    $request->session()->regenerate();
                    return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
                }
                if ($response->ok()) {
                    Cache::forget('schedule_metadata');
                    return $this->success('', 'Pengaturan penagihan berhasil diperbaharui', 200);
                }
            });

            return DataTables::of($data)
            ->rawColumns(['action', 'status'])
            ->make(true);
        }
        return view('wms.config.settings.sechedule', [
            'title' => 'Sechedule config'
        ]);
    }

    public function secheduleUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'time' => 'required',
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->put(config('app.api_service') . '/config/schedule/'.$id, $validator->validate());
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if ($response->ok()) {
                Cache::forget('schedule_metadata');
                return $this->success('', 'Pengaturan penagihan berhasil diperbaharui', 200);
            }
        } catch (\Throwable $th) {
           Log::error('Tidak dapat memperbaharui pengaturan penagihan ' . $th->getMessage());
           return $this->error('Internal Server Error');
        }
    }

    public function billing(Request $request)
    {
        if($request->ajax()) {
            $data = Cache::rememberForever('billing_metadata', function () {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/config/billing');
                if ($response->ok()) {
                    return $response->json('metadata');
                }
                return [];
            });
           return $this->success($data, 'Pengaturan penagihan');
        }
        return view('wms.config.settings.billing', [
            'title' => 'Pengaturan penagihan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                'date_invoice' => 'required|integer',
                'date_reminder' => 'required|integer',
                'due_date' => 'required|integer',
                'date_suspend' => 'required|integer',
            ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->put(config('app.api_service') . '/config/billing/'.$id, $validator->validate());
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if ($response->ok()) {
                Cache::forget('billing_metadata');
                return $this->success('', 'Pengaturan penagihan berhasil diperbaharui', 200);
            }
        } catch (\Throwable $th) {
           Log::error('Tidak dapat memperbaharui pengaturan penagihan ' . $th->getMessage());
           return $this->error('Internal Server Error');
        }
    }

    public function registration(Request $request)
    {
        if ($request->ajax()) {
            $responseData = Cache::rememberForever('registration_data', function () {
                $responses = Http::pool(fn (Pool $pool) => [
                    $pool->withToken(session('api_token'))->get(config('app.api_service') . '/config/registration/status'),
                    $pool->withToken(session('api_token'))->get(config('app.api_service') . '/config/registration/price'),
                ]);

                return [
                    'registrationStatus' => $responses[0]->json('metadata'),
                    'registrationPrice' => $responses[1]->json('metadata'),
                ];
            });

            return $this->success($responseData, 'Data status registrasi dan harga registrasi', 200);
        }
        return view('wms.config.settings.registration', [
            'titile'    => 'Pengaturan pendaftaran'
        ]);
    }

    public function registrationUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/registration/status', $validator->validate());
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if ($response->successful()) {
                Cache::forget('registration_data');
                return $this->success('', 'Pengaturan pendaftaran berhasil diperbaharui', 200);
            }
        } catch (\Throwable $th) {
           Log::error('Tidak dapat memperbaharui pengaturan pendaftaran ' . $th->getMessage());
           return $this->error('Internal Server Error');
        }
    }

    public function registrationPrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => ['required', 'regex:/^[\d.]+$/']
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        $price = str_replace('.','', $request->price);
        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/config/registration/price', ['price' => $price]);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if ($response->successful()) {
                Cache::forget('registration_data');
                return $this->success('', 'Pengaturan pendaftaran berhasil diperbaharui', 200);
            }
        } catch (\Throwable $th) {
           Log::error('Tidak dapat memperbaharui pengaturan pendaftaran ' . $th->getMessage());
           return $this->error('Internal Server Error');
        }
    }
}
