@extends('layouts.app')
@push('css')
    <style>
        .gradient-card {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 50%, #60a5fa 100%);
            border: none;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .gradient-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 1;
        }

        .gradient-card::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            z-index: 1;
        }

        .card-content {
            position: relative;
            z-index: 2;
        }

        .icon-container {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .icon-container i {
            font-size: 24px;
            color: white;
        }

        .card-number {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0;
            line-height: 1;
        }

        .card-label {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .filter-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card gradient-card">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-user-plus"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="totalUser">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">Total pengguna</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card gradient-card">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-user-check"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="userActive">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">Pengguna aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card gradient-card">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-user-x"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="userSuspended">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">Pengguna ditangguhkan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card gradient-card pt-1 pb-2">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-wifi"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="userInternet">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">Pengguna online</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card gradient-card">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-calculator"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="totalInvoice">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">Total tagihan</p>
                            <span class="fw-bold fs-6 estimatedMonthlyIncome">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card gradient-card">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-alarm"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="unpaidInvoice">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">Tagihan belum dibayar</p>
                            <span class="fw-bold fs-6" id="unpaidCurrentMonth">Rp 250.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card gradient-card">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-wallet"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="paidInvoice">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">Tagihan dibayar</p>
                            <span class="fw-bold fs-6" id="paidCurrentMonth">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card gradient-card">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-alarm"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="overdueInvoice">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">Tagihan jatuh tempo</p>
                            <span class="fw-bold fs-6" id="countOverdueBilling">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card gradient-card pt-1 pb-2">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-wallet"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white estimatedMonthlyIncome">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">Estimasi pendapatan bulan ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Expense Overview -->
        <div class="col-md-8 col-lg-8 order-1 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title m-0 me-2">Pertumbuhan pendapatan perusahaan tahun 2025</h5>
                </div>
                <div class="card-body px-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                            <div id="totalRevenueChart"></div>
                            <div class="d-flex justify-content-center pt-4 gap-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Expense Overview -->
        <!-- Transactions -->
        <div class="col-md-6 col-lg-4 order-2 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Pembayaran terbaru bulan ini</h5>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <div id="placholder">
                            <li class="d-flex mb-4 pb-1 placeholder-glow">
                                <span class="placeholder col-12 p-3"></span>
                            </li>
                            <li class="d-flex mb-4 pb-1 placeholder-glow">
                                <span class="placeholder col-12 p-3"></span>
                            </li>
                            <li class="d-flex mb-4 pb-1 placeholder-glow">
                                <span class="placeholder col-12 p-3"></span>
                            </li>
                            <li class="d-flex mb-4 pb-1 placeholder-glow">
                                <span class="placeholder col-12 p-3"></span>
                            </li>
                            <li class="d-flex mb-4 pb-1 placeholder-glow">
                                <span class="placeholder col-12 p-3"></span>
                            </li>
                            <li class="d-flex mb-4 pb-1 placeholder-glow">
                                <span class="placeholder col-12 p-3"></span>
                            </li>
                        </div>

                        <div id="dataTransaction" class="d-none">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="https://ui-avatars.com/api/?background=2563eb&name=Andi Saputra&color=fff"
                                        alt="User" class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Transfer</small>
                                        <h6 class="mb-0">Andi Saputra</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">Rp. 250.000</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="https://ui-avatars.com/api/?background=2563eb&name=Rina Marlina&color=fff"
                                        alt="User" class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Transfer</small>
                                        <h6 class="mb-0">Rina Marlina</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">Rp. 250.000</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="https://ui-avatars.com/api/?background=2563eb&name=Budi Santoso&color=fff"
                                        alt="User" class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Cash</small>
                                        <h6 class="mb-0">Budi Santoso</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">Rp. 250.000</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="https://ui-avatars.com/api/?background=2563eb&name=Siti Rahmawati&color=fff"
                                        alt="User" class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Transfer</small>
                                        <h6 class="mb-0">Siti Rahmawati</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">Rp. 250.000</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="https://ui-avatars.com/api/?background=2563eb&name=Dedi Kurniawan&color=fff"
                                        alt="User" class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Transfer</small>
                                        <h6 class="mb-0">Dedi Kurniawan</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">Rp. 250.000</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="https://ui-avatars.com/api/?background=2563eb&name=Lina Agustin&color=fff"
                                        alt="User" class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">Cash</small>
                                        <h6 class="mb-0">Lina Agustin</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">Rp. 250.000</h6>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Transactions -->
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(async function() {

            let param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    'load': 'dashboard-summery'
                }
            }

            await transAjax(param).then((result) => {
                let data = result.metadata;

                $("#totalUser").html(data.total_users);
                $("#userActive").html(data.active_users);
                $("#userSuspended").html(data.suspended_users);
                $("#userInternet").html(data.internet_users);
                $("#totalInvoice").html(data.total_invoices);
                $("#unpaidInvoice").html(data.unpaid_invoices);
                $("#paidInvoice").html(data.paid_invoices);
                $("#overdueInvoice").html(data.overdue_invoices);
                $(".estimatedMonthlyIncome").html(data.estimated_monthly_income);
                $("#paidCurrentMonth").html(data.paid_current_month);
                $("#unpaidCurrentMonth").html(data.unpaid_current_month);
                $("#countOverdueBilling").html(data.count_overdue_billing);

            }).catch((err) => {
                return alert('Gagal mengambil data dashboard summery');
            });

            setTimeout(() => {
                $("#placholder").addClass('d-none');
                $("#dataTransaction").removeClass('d-none');
            }, 3000);
        });
    </script>
@endpush
