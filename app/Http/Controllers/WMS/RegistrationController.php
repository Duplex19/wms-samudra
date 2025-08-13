<?php

namespace App\Http\Controllers\WMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Cache::rememberForever('registration_metadata', function () use ($request) {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') .'/admin/registration');
                if ($response->status() === 401) {
                    session()->forget(['api_token', 'user_data']);
                    $request->session()->invalidate();
                    $request->session()->regenerate();
                    return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
                }else {
                    return $response->json('metadata');
                }
            });

            return DataTables::of($data)
            ->rawColumns(['action', 'status'])
            ->make(true);
        }

        return view('wms.registration.index', [
            'title' => 'List data registrasi'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "category" => "required|in:retail,corporate",
            "profile_ppp_id" => "required",
            "nama_lengkap" => "required",
            "alamat" => "required",
            "no_whatsapp" => "required",
            "nik" => "required",
            "foto_selvie" => "required|image|mimes:jpg,jpeg,png|max:2048",
            "foto_ktp" => "required|image|mimes:jpg,jpeg,png|max:2048",
            "foto_lokasi" => "required|image|mimes:jpg,jpeg,png|max:2048",
            "disclaimer" => "required",
            "latitude" => "required",
            "longitude" => "required",
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        $data = $validator->validate();
        if ($request->npwp) {
            $data['npwp'] = $request->npwp;
        }

        $http = Http::withToken(session('api_token'));

        $http->attach(
            'foto_selvie',
            file_get_contents($request->file('foto_selvie')->getRealPath()),
            $request->file('foto_selvie')->getClientOriginalName()
        )->attach(
            'foto_ktp',
            file_get_contents($request->file('foto_ktp')->getRealPath()),
            $request->file('foto_ktp')->getClientOriginalName()
        )->attach(
            'foto_lokasi',
            file_get_contents($request->file('foto_lokasi')->getRealPath()),
            $request->file('foto_lokasi')->getClientOriginalName()
        );

        if ($request->hasFile('foto_npwp')) {
            $http->attach(
                'foto_npwp',
                file_get_contents($request->file('foto_npwp')->getRealPath()),
                $request->file('foto_npwp')->getClientOriginalName()
            );
        }

        try {
            $response = $http->post(config('app.api_service') . '/admin/registration', $data);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            if($response->ok()) {
                Cache::forget('registration_metadata');
                return $this->success('', 'Pelanggan baru berhasil ditambahkan', 201);
            }else {
                return $this->error($response->json('message'), 500);
            }
        } catch (\Throwable $th) {
            Log::error('Gagal saat menambahkan pelanggan baru ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }
}
