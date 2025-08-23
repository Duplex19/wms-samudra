<?php

namespace App\Http\Controllers\WMS\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class BalanceController extends Controller
{
       public function index(Request $request)
    {
         if ($request->ajax()) {
            $response = Http::withToken(session('api_token'))->get(config('app.api_service') .'/admin/finance/balance');
            if ($response->status() === 401) {
                session()->forget(['api_token', 'user_data']);
                $request->session()->invalidate();
                $request->session()->regenerate();
                return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            }
            
            if($request->category == 'balance_summary') {
                return $this->success($response->json('metadata'), 'Balance summary', 200);
            }else {
                return DataTables::of($response->json('metadata')['users'])
                ->make(true);
            }
            // switch ($request->category) {
            //     case 'inv_summary':
            //         try {
            //             $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/admin/finance/balance');
            //             if ($response->status() === 401) {
            //                 session()->forget(['api_token', 'user_data']);
            //                 $request->session()->invalidate();
            //                 $request->session()->regenerate();
            //                 return $this->unauthorized('Sesi Anda telah habis. Silakan login kembali.', 401);
            //             }
            //             return $this->success($response->json('metadata'), 'Data dashboard summery');
            //         } catch (\Throwable $th) {
            //             Log::error('Error pada saat mengambil data summary dashbaord ' . $th->getMessage());
            //             return $this->error('Error pada saat mengambil data summary dashbaord', 500);
            //         }
            //         break;
            //     case 'list_pppoe':
            //         try {
            //             $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/member/pppoe');
            //             if ($response->ok()) {
            //                 return $this->success($response->json('metadata'), 'List data pppoe');
            //             }
            //         } catch (\Throwable $th) {
            //             Log::error('Tidak dapat memperbaharui pengaturan penagihan ' . $th->getMessage());
            //             return $this->error('Internal Server Error');
            //         }
            //         break;
            //     default:
            //     $data = Cache::rememberForever('invoice_metadata', function () {
            //         $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/member/invoice');
            //         if ($response->ok()) {
            //             return $response->json('metadata');
            //         }
            //         return [];
            //     });
                
            //     return DataTables::of($data)
            //         ->addIndexColumn()
            //         ->addColumn('action', function($row) {
            //             if($row['status'] !== 'paid') {
            //                 return '
            //                     <button class="btn btn-sm bg-success view-btn text-white" onclick="sendReminder(`'.$row['id'].'`)">
            //                         <i class="fab fa-whatsapp"></i> Kirim pengingat
            //                     </button>
            //                         <button class="btn btn-sm btn-info view-btn" onclick="copyLink(`'.$row['inv_link'].'`)">
            //                             <i class="fas fa-link"></i> Link pembayaran
            //                         </button>
            //                     <button class="btn btn-sm btn-primary view-btn" onclick="payment(`'.$row['id'].'`)">
            //                         <i class="fas fa-credit-card"></i> Bayar
            //                     </button>
            //                     <button class="btn btn-sm btn-warning view-btn" onclick="editData(\'' . $row['id'] . '\', \'' . $row['amount'] . '\')">
            //                         <i class="fas fa-pencil"></i> Edit
            //                     </button>
            //                     <button class="btn btn-sm btn-danger view-btn" onclick="hapus(`/wms/member/invoice/delete/'.$row['id'].'`)">
            //                         <i class="fas fa-trash"></i> Hapus
            //                     </button>
            //                 ';
            //             }else {
            //                 return '
            //                     -
            //                 ';
            //             }
                        
            //         })
            //         ->editColumn('paid_date', function($row) {
            //             return $row['paid_date'] ?? '<span class="text-muted">Belum dibayar</span>';
            //         })
            //         ->editColumn('payment_method', function($row) {
            //             return $row['payment_method'] ?? '<span class="text-muted">Belum ada</span>';
            //         })
            //         ->editColumn('whatsapp', function($row) {
            //             return '<a href="https://wa.me/'.$row['whatsapp'].'" target="_blank" class="text-success">
            //                         '.$row['whatsapp'].'
            //                     </a>';
            //         })
            //         ->filter(function ($query) use ($request) {
            //             // Filter by status
            //             // if ($request->has('status') && $request->status !== 'all') {
            //             //     $query->where('status', $request->status);
            //             // }
                        
            //             // Filter by payment method
            //             if ($request->has('payment_method') && $request->payment_method !== 'all') {
            //                 if ($request->payment_method === 'null') {
            //                     $query->whereNull('payment_method');
            //                 } else {
            //                     $query->where('payment_method', 'like', '%' . $request->payment_method . '%');
            //                 }
            //             }
                        
            //             // Filter by date range
            //             if ($request->has('date_from') && $request->date_from) {
            //                 $query->whereDate('created_at', '>=', $request->date_from);
            //             }
                        
            //             if ($request->has('date_to') && $request->date_to) {
            //                 $query->whereDate('created_at', '<=', $request->date_to);
            //             }
            //         })
            //         ->rawColumns(['action', 'status', 'paid_date', 'payment_method', 'whatsapp'])
            //         ->make(true);
            //     break;
            // }
        }
        return view('wms.member.invoice.index', [
            'title' => 'Penagihan'
        ]);
    }
}
