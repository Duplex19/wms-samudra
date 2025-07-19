<?php

namespace App\Http\Controllers\WMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            try {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/admin/dashboard/summary');
                if ($response->status() === 401) {
                    session()->forget(['api_token', 'user_data']);
                    $request->session()->invalidate();
                    $request->session()->regenerate();
                    return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
                }
                return $this->success($response->json('metadata'), 'Data dashboard summery');
            } catch (\Throwable $th) {
                Log::error('Error pada saat mengambil data summary dashbaord ' . $th->getMessage());
                return $this->error('Error pada saat mengambil data summary dashbaord', 500);
            }
        }
        return view('wms.dashboard.index');
    }
}
