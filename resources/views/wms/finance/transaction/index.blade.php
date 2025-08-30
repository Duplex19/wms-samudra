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

    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endpush
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-4 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-dollar-circle"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white" id="xendit_balance">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </h2>
                        <p class="card-label">{{ __('cms.xendit_balance') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="col-lg-4 col-md-4 col-12 mb-4">
        <a href="{{ route('wms.registrationx') }}">
            <div class="card gradient-card">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-dollar-circle"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="registration_balance">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">{{ __('cms.registration_balance') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-4 col-12 mb-4">
        <a href="{{ route('wms.member.invoice') }}">
            <div class="card gradient-card">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-dollar-circle"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="invoice_balance">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">{{ __('cms.billing_balance') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-4 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-dollar-circle"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white" id="outgoing_balance">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </h2>
                        <p class="card-label">{{ __('cms.expense') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="col-lg-4 col-md-4 col-12 mb-4">
        <a href="{{ route('wms.users.index') }}">
            <div class="card gradient-card">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-dollar-circle"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="team_balance">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">{{ __('cms.team_balance') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-4 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-dollar-circle"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white" id="withdrawable_balance">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </h2>
                        <p class="card-label">{{ __('cms.withdrawable_balance') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <h5 class="card-header">{{ __('cms.sidebar_transaction') }}</h5>
    <div class="card-body">
        <div class="table-responsive">
                <table class="table table-sm text-nowrap" id="employeeBalance">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>{{ __('cms.ref_id') }}</th>
                            <th>{{ __('cms.category') }}</th>
                            <th>{{ __('cms.type') }}</th>
                            <th>{{ __('cms.amount') }}</th>
                            <th>{{ __('cms.final_amount') }}</th>
                            <th>{{ __('cms.payment_method') }}</th>
                            <th>{{ __('cms.status') }}</th>
                            <th>{{ __('cms.date') }}</th>
                            <th>{{ __('cms.link') }}</th>
                            <th>{{ __('cms.description') }}</th>
                            <th>{{ __('cms.contact') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <x-loadingTable /> --}}
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        getInvSummary();
        getDataTable();
    });

    async function getInvSummary()
    {
        let param = {
            url: "{{ url()->current() }}",
            method: "GET",
            data: {
                'category': 'financial_summary'
            }
        };

        await transAjax(param).then((result) => {
                $("#xendit_balance").html(result.metadata.xendit_balance);
                $("#registration_balance").html(result.metadata.registration_balance);
                $("#invoice_balance").html(result.metadata.invoice_balance);
                $("#outgoing_balance").html(result.metadata.outgoing_balance);
                $("#team_balance").html(result.metadata.team_balance);
                $("#withdrawable_balance").html(result.metadata.withdrawable_balance);
        }).catch((err) => {
            return alert('Gagal mengambil data summary');
        });
    }

    function  getDataTable()
    {
        let currentLang = localStorage.getItem("locale") || "id";

        let langOptions = {};

        if (currentLang === "id") {
            langOptions = {
                processing: "Sedang memproses...",
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                loadingRecords: "Memuat data...",
                zeroRecords: "Tidak ada data yang ditemukan",
                emptyTable: "Tidak ada data yang tersedia",
                paginate: {
                    first: "Pertama",
                    previous: "Sebelumnya",
                    next: "Selanjutnya",
                    last: "Terakhir"
                }
            };
        } 

        dataTable = $('#employeeBalance').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url()->current() }}',
            data: function(d) {
                d.status = $('#status-filter').val();
                d.payment_method = $('#payment-method-filter').val();
                d.date_from = $('#date-from').val();
                d.date_to = $('#date-to').val();
            }
        },
        columns: [
            { 
            data: null,
            name: 'No',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'ref_id', ref_id: 'name' },
            { data: 'category', category: 'category' },
            { data: 'type', name: 'type', render: function(data) {
                let badgeClass = 'bg-secondary'; 
                if (data.toLowerCase() === 'in') {
                    badgeClass = 'bg-success';
                } else if (data.toLowerCase() === 'out') {
                    badgeClass = 'bg-danger';
                }
                return `<span class="badge ${badgeClass} rounded">${data}</span>`;
            }},
            { data: 'amount', name: 'amount'},
            { data: 'final_amount', name: 'final_amount'},
            { data: 'payment_method', name: 'payment_method', render: function(data) {
                return data ? data : 'Tidak diketahui';
            }},
            { data: 'status', name: 'status', render: function(data) {
                let badgeClass = 'bg-secondary'; 
                if (data.toLowerCase() === 'success') {
                    badgeClass = 'bg-success';
                } else if (data.toLowerCase() === 'failed') {
                    badgeClass = 'bg-danger';
                }
                return `<span class="badge ${badgeClass} rounded-pill">${data}</span>`;
            }},
            { data: 'date', name: 'date'},
            { data: 'link', name: 'link', render: function(data) {
                return `<a href="${data}">${data}</a>`
            }},
            { data: 'description', name: 'description'},
            { data: 'contact', name: 'contact', render: function(data) {
                return `<a href="https://wa.me/${data}" class="badge bg-info cursor-pointer">${data}</a>`
            }},
        ],
        order: [[1, 'asc']], // Order by ref_id desc
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        language:langOptions,
        responsive: true,
        autoWidth: false,
        });

    }
    </script>
@endpush