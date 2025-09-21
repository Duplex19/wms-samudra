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
        if ($request->ajax()) {
            if ($request->category == 'financial_summary') {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/admin/finance/transaction/summary');
                if ($response->status() === 401) {
                    session()->forget(['api_token', 'user_data']);
                    $request->session()->invalidate();
                    $request->session()->regenerate();
                    return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
                }
                return $this->success($response->json('metadata'), 'Data summary finance', 200);
            } else {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/salary/history');
                return DataTables::of($response->json('metadata'))
                    ->make(true);
            }
        }

        return view('wms.finance.salary.index', [
            'title' => 'Employes Salary',
            'user_pin' => session('user_pin.blast_salary') ? 'active' : 'inactive',
        ]);
    }

    public function salaryManagment(Request $request)
    {
        if($request->ajax()) {
            if($request->load == 'users') {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/admin/users');
                if ($response->status() === 401) {
                    session()->forget(['api_token', 'user_data']);
                    $request->session()->invalidate();
                    $request->session()->regenerate();
                    return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
                }
                return $this->success($response->json('metadata'), 'Data user', 200);
            }else {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/salary');
                if ($response->status() === 401) {
                    session()->forget(['api_token', 'user_data']);
                    $request->session()->invalidate();
                    $request->session()->regenerate();
                    return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
                }
                return view('wms.finance.salary._data_salary', ['data' => $response->json('metadata')]);
            }
            
        }
        return view('wms.finance.salary.salary_management');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'   => 'required',
            'amount'    => 'required',
            'get_sallary'  => 'required',
        ],[
            'user_id.required'  => 'User wajib dipilih!',
            'amount.required'  => 'Jumlah gaji wajib ditentukan!'
        ]);

        if($validator->fails()) {
              return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        $amount = (int) preg_replace('/\D/', '', $request->amount);
        $data = $validator->validate();
        $data['amount'] = $amount;

        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/salary', $data);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            return $this->success('', 'Gaji user berhasil dibuat', 201);
            Log::info('Berhasil membuat gaji user');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Gagal saat membuat gaji user ' .  $th->getMessage());
            return $this->error('Internal Server Error ' . $th->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id'   => 'required',
            'amount'    => 'required',
            'get_sallary'  => 'required',
        ],[
            'user_id.required'  => 'User wajib dipilih!',
            'amount.required'  => 'Jumlah gaji wajib ditentukan!'
        ]);

        if($validator->fails()) {
              return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        $amount = (int) preg_replace('/\D/', '', $request->amount);
        $data = $validator->validate();
        $data['amount'] = $amount;

        try {
            $response = Http::withToken(session('api_token'))->put(config('app.api_service') . '/salary/'. $id, $data);
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            return $this->success('', 'Gaji user berhasil diperbaharui', 201);
            Log::info('Gaji user berhasil diperbaharui');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Gagal saat memperbaharui gaji user ' .  $th->getMessage());
            return $this->error('Internal Server Error ' . $th->getMessage());
        }
        
    }

    public function salaryBlast(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "pin" => "required|max:6",
        ]);

        if ($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/salary/blast', [
                'key_name' => 'blast_salary',
                'pin' => implode('', $request->pin)

            ]);

            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            // dd($response->json());
            if ($response->json('success')) {
                // dd(true);
                Log::info('Berhasil blast gaji ' . $request->key_name . '-' . session('user_data.name'));
                return $this->success('', $response->json('message'));
            } else {
                // dd(false);
                Log::error('Blast gaji gagal ' . $response->body());
                return $this->error($response->json('message'), 500);
            }

        } catch (\Throwable $th) {
            Log::error('Blast gaji gagal ' . $th->getMessage());
            return $this->error('Internal Server Error. Silakan hubungi Administrator', 500);
        }
    }
}
