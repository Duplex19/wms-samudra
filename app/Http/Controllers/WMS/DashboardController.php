<?php

namespace App\Http\Controllers\WMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

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
                return $this->success($response->json('metadata'), 'Data dashboard summery');
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        return view('wms.dashboard.index');
    }
}
