<?php

namespace App\Http\Controllers\WMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

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
}
