<?php

namespace App\Http\Controllers\WMS\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        // dd(session('user_pin.blast_salary'));
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
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') .'/salary');
                return DataTables::of($response->json('metadata'))
                ->make(true);
            }
        }
        
        return view('wms.finance.salary.index', [
            'title' => 'Employes Salary',
            'user_pin'  => session('user_pin.blast_salary') ? 'active' : 'inactive',
        ]);
    }

    public function salaryBlast(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "pin" => "required|max:6",
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/salary/blast', [
                'key_name'  => 'blast_salary',
                'pin'   =>  implode('', $request->pin)

            ]);

            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }

            if($response->ok()) {
                Log::info('Berhasil blast gaji ' . $request->key_name . '-' . session('user_data.name'));
                return $this->success('', $response->body()['message']);
            }else {
                Log::error('Blast gaji gagal ' . $response->body());
                return $this->error($response->body()['message'], 500);
            }
            
        } catch (\Throwable $th) {
            Log::error('Blast gaji gagal ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }
}
