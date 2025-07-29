<?php

namespace App\Http\Controllers\WMS\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Cache::remember('customer_metadata', now()->addMinute(), function () {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') .'/member/customer');
                if ($response->ok()) {
                    return $response->json('metadata');
                }
                return [];
            });

            return DataTables::of($data)
            ->make(true);
        }
       return view('wms.member.customer.index');
    }

    public function update(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "whatsapp" => "required",
            "active_date" => "required",
            "address" => "required",
            "payment_type" => "required",
            "discount"  => 'required'
        ]);

        $data =  $validator->validate();
        if($request->note) {
            $data['note'] = $request->note;
        };

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->put(config('app.api_service') . '/member/customer/' . $id,  $data);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if($response->successful()) {
                Cache::forget('customer_metadata');
                return $this->success('', 'Data anggota berhasil diupdate', 200);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Data anggota gagal diupdate ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }
}
