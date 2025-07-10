<?php

namespace App\Http\Controllers\WMS\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $response = Http::withToken(session('api_token'))->get(config('app.api_service') . '/member/invoice');
            
            if ($response->successful()) {
                $data = $response->json();
                $invoices = collect($data['metadata'] ?? []);
                
                return DataTables::of($invoices)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '
                            <button class="btn btn-sm btn-primary view-btn" data-id="'.$row['id'].'">
                                <i class="fab fa-whatsapp"></i> Bayar
                            </button>
                            <button class="btn btn-sm btn-info view-btn" data-id="'.$row['id'].'">
                                <i class="fas fa-link"></i> Link pembayaran
                            </button>
                            <button class="btn btn-sm btn-warning view-btn" data-id="'.$row['id'].'">
                                <i class="fas fa-pencil"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger view-btn" data-id="'.$row['id'].'">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        ';
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
            
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
        return view('wms.member.invoice.index', [
            'title' => 'Penagihan'
        ]);
    }

}
