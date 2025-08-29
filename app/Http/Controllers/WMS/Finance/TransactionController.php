<?php

namespace App\Http\Controllers\WMS\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $response = Http::withToken(session('api_token'))->get(config('app.api_service') .'/admin/finance/transaction');
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            
            if($request->category == 'transaction_summary') {
                return $this->success($response->json('metadata'), 'Balance summary', 200);
            }else {
                return DataTables::of($response->json('metadata'))
                ->make(true);
            }
        }
        
        return view('wms.finance.transaction.index', [
            'title' => 'Penagihan'
        ]);
    }
}
