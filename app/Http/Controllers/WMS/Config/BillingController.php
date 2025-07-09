<?php

namespace App\Http\Controllers\WMS\Config;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    public function index(Request $request)
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
        return view('wms.config.billing.index', [
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
            if ($response->ok()) {
                Cache::forget('billing_metadata');
                return $this->success('', 'Pengaturan penagihan berhasil diperbaharui', 200);
            }
        } catch (\Throwable $th) {
           Log::error('Tidak dapat memperbaharui pengaturan penagihan ' . $th->getMessage());
           return $this->error('Internal Server Error');
        }
    }
}
