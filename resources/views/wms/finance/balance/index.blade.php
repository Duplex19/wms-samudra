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

        /* Belum dibuka */
        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
            content: "\f0fe" !important; /* fa-plus-square */
            font-family: "Font Awesome 6 Free"; /* sesuaikan dengan versimu */
            font-weight: 900;
        }

        /* Sudah dibuka */
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td.dtr-control:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th.dtr-control:before {
            content: "\f146" !important;  /* fa-minus-square */
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
        }

        .dtr-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px !important;
            margin: 10px 0;
            width: 100% !important;
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
                        <i class="tf-icons bx bx-wallet-alt"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white" id="totalBalance">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </h2>
                        <p class="card-label">{{ __('cms.balance_xendit') }}</p>
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
                        <i class="tf-icons bx bx-wallet-alt"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white" id="totalRegistrationBalance">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </h2>
                        <p class="card-label">{{ __('cms.balance_registrasi') }}</p>
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
                        <i class="tf-icons bx bx-wallet-alt"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white" id="totalBalanceThisMonth">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </h2>
                        <p class="card-label">{{ __('cms.balance_invoice') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <h4 class="card-header">{{ __('cms.balance_employes') }}</h4>
    <div class="card-body">
        <div class="table-responsive">
                <table class="table table-sm text-nowrap" id="employeeBalance">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>{{ __('cms.name') }}</th>
                            <th>{{ __('cms.balance') }}</th>
                            <th>{{ __('cms.action') }}</th>
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
    });

    async function getInvSummary()
    {
        let param = {
            url: "{{ url()->current() }}",
            method: "GET",
            data: {
                'category': 'balance_summary'
            }
        };

        await transAjax(param).then((result) => {
            $("#totalBalance").html('Rp ' +result.metadata.balance_xendit.toLocaleString("id-ID"));
            $("#totalRegistrationBalance").html('Rp '+result.metadata.balance_registrasi.toLocaleString("id-ID"));
            $("#totalBalanceThisMonth").html('Rp '+result.metadata.balance_invoice.toLocaleString("id-ID"));
        }).catch((err) => {
            return alert('Gagal mengambil data summary');
        });

        getDataTable();
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
            { data: 'name', name: 'name' },
            { data: 'balance', name: 'balance', render: function(data) {
                return `Rp ${data.toLocaleString("id-ID")}`;
            }},
            {
                data: null,
                name: 'aksi',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <span class="btn btn-primary btn-sm")'>{{ __('cms.balance_view_transaction_history') }}</span>
                        <span class="btn btn-danger btn-sm")'>{{ __('cms.balance_freeze') }}</span>
                    `;
                }
            }
        ],
        order: [[1, 'asc']], // Order by ref_id desc
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        language:langOptions,
        responsive: true,
        autoWidth: false,
        columnDefs: [
            { targets: 0, width: "10%" }, 
            { targets: 1, width: "60%" }, 
            { targets: 2, width: "30%" }
        ]
        });

    }
    </script>
@endpush