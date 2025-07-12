<?php

namespace App\Http\Controllers\WMS\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class InvoiceController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = Cache::rememberForever('invoice_metadata', function () {
                $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/member/invoice');
                if ($response->ok()) {
                    return $response->json('metadata');
                }
                return [];
            });
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    if($row['status'] !== 'paid') {
                        return '
                            <button class="btn btn-sm bg-success view-btn text-white" onclick="sendReminder(`'.$row['id'].'`)">
                                <i class="fab fa-whatsapp"></i> Kirim pengingat
                            </button>
                                <button class="btn btn-sm btn-info view-btn" onclick="copyLink(`'.$row['inv_link'].'`)">
                                    <i class="fas fa-link"></i> Link pembayaran
                                </button>
                            <button class="btn btn-sm btn-primary view-btn" onclick="payment(`'.$row['id'].'`)">
                                <i class="fas fa-credit-card"></i> Bayar
                            </button>
                            <button class="btn btn-sm btn-warning view-btn" onclick="editData(`'.$row['id'].'`)">
                                <i class="fas fa-pencil"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger view-btn" onclick="hapus(`/wms/member/invoice/delete/'.$row['id'].'`)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        ';
                    }else {
                        return '
                            <button class="btn btn-sm btn-info view-btn" onclick="copyLink(`'.$row['inv_link'].'`)">
                                <i class="fas fa-link"></i> Link pembayaran
                            </button>
                            <button class="btn btn-sm btn-warning view-btn" onclick="editData(\'' . $row['id'] . '\', \'' . $row['amount'] . '\')">
                                <i class="fas fa-pencil"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger view-btn" onclick="hapus(`/wms/member/invoice/delete/'.$row['id'].'`)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        ';
                    }
                    
                })
                ->editColumn('paid_date', function($row) {
                    return $row['paid_date'] ?? '<span class="text-muted">Belum dibayar</span>';
                })
                ->editColumn('payment_method', function($row) {
                    return $row['payment_method'] ?? '<span class="text-muted">Belum ada</span>';
                })
                ->editColumn('whatsapp', function($row) {
                    return '<a href="https://wa.me/'.$row['whatsapp'].'" target="_blank" class="text-success">
                                '.$row['whatsapp'].'
                            </a>';
                })
                ->filter(function ($query) use ($request) {
                    // Filter by status
                    // if ($request->has('status') && $request->status !== 'all') {
                    //     $query->where('status', $request->status);
                    // }
                    
                    // Filter by payment method
                    if ($request->has('payment_method') && $request->payment_method !== 'all') {
                        if ($request->payment_method === 'null') {
                            $query->whereNull('payment_method');
                        } else {
                            $query->where('payment_method', 'like', '%' . $request->payment_method . '%');
                        }
                    }
                    
                    // Filter by date range
                    if ($request->has('date_from') && $request->date_from) {
                        $query->whereDate('created_at', '>=', $request->date_from);
                    }
                    
                    if ($request->has('date_to') && $request->date_to) {
                        $query->whereDate('created_at', '<=', $request->date_to);
                    }
                })
                ->rawColumns(['action', 'status', 'paid_date', 'payment_method', 'whatsapp'])
                ->make(true);
        }
        return view('wms.member.invoice.index', [
            'title' => 'Penagihan'
        ]);
    }

    public function sendReminder($id)
    {
        try {
            $response = Http::withToken(session('api_token'))->post(config('app.api_service') . '/member/invoice/send_reminder/'.$id);
            if ($response->successful()) {
                // Cache::forget('billing_metadata');
                return $this->success('', 'Pengaturan penagihan berhasil diperbaharui', 200);
            }
        } catch (\Throwable $th) {
           Log::error('Tidak dapat memperbaharui pengaturan penagihan ' . $th->getMessage());
           return $this->error('Internal Server Error');
        }
    }

    public function payment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|in:cash,bank transfer',
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        try {
            $response = Http::withToken(session('api_token'))->put(config('app.api_service') . '/member/invoice/update_status/'.$id, $validator->validate());
            if ($response->successful()) {
                Cache::forget('invoice_metadata');
                return $this->success('', 'Pembayaran berhasil diperbaharui', 200);
            }
        } catch (\Throwable $th) {
           Log::error('Tidak dapat memperbaharui pembayaran ' . $th->getMessage());
           return $this->error('Internal Server Error', 500);
        }
    }

    public function paymentUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ]);

        if($validator->fails()) {
            return $this->error('Data tidak dapat diproses', $validator->errors(), 422);
        }

        $amount = str_replace('.', '', $request->amount);
        try {
            $response = Http::withToken(session('api_token'))->put(config('app.api_service') . '/member/invoice/'.$id, ['amount'=>$amount]);
            if ($response->successful()) {
                Cache::forget('invoice_metadata');
                return $this->success('', 'Jumlah pembayaran berhasil diperbaharui', 200);
            }
        } catch (\Throwable $th) {
           Log::error('Tidak dapat memperbaharui jumlah pembayaran ' . $th->getMessage());
           return $this->error('Internal Server Error', 500);
        }
    }

    public function delete($id)
    {
        try {
            $response = Http::withToken(session('api_token'))->delete(config('app.api_service') . '/member/invoice/'.$id);
            if ($response->successful()) {
                Cache::forget('invoice_metadata');
                return $this->success('', 'Invoice berhasil dihapus', 200);
            }
        } catch (\Throwable $th) {
           Log::error('Tidak dapat menghapus Invoice ' . $th->getMessage());
           return $this->error('Internal Server Error', 500);
        }
    }
}
