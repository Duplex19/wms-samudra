<?php

namespace App\Http\Controllers\WMS\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {
            if($request->category == 'financial_summary') {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') .'/admin/finance/transaction/summary');
                if ($response->status() === 401) {
                    session()->forget(['api_token', 'user_data']);
                    $request->session()->invalidate();
                    $request->session()->regenerate();
                    return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
                }
                return $this->success($response->json('metadata'), 'Data summary finance', 200);
            }else {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') .'/users/gaji');
                return DataTables::of($response->json('metadata'))
                ->make(true);
            }
        }
        
        return view('wms.finance.salary.index', [
            'title' => 'Employes Salary'
        ]);
    }
}
