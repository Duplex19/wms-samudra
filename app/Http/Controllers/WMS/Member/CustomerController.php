<?php

namespace App\Http\Controllers\WMS\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Cache::remember('logs_metadata', now()->addMinute(), function () {
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
}
