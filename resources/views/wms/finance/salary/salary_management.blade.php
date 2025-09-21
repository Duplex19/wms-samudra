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

        .employee-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }

        .employee-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .employee-header {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            padding: 1.5rem;
        }

        .salary-amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2563eb;
        }

        .status-badge {
            background-color: #10b981;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .bank-info {
            background-color: #f1f5f9;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        .action-buttons .btn {
            margin: 0 0.25rem;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .search-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
@section('content')
    <!-- Statistics Cards -->
    <div class="row mb-2">
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card gradient-card">
                <div class="card-body card-content">
                    <div class="d-flex align-items-center">
                        <div class="icon-container">
                            <i class="tf-icons bx bx-dollar-circle"></i>
                        </div>
                        <div>
                            <h2 class="card-number text-white" id="total_user">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h2>
                            <p class="card-label">Total Karyawan</p>
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
                                    Rp. 500.000.000
                                    {{-- <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div> --}}
                                </h2>
                                <p class="card-label">Total Gaji Tim</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
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
                                    Rp. 900.0000
                                    {{-- <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div> --}}
                                </h2>
                                <p class="card-label">Total Gaji Terbayar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="search-section">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Cari nama karyawan...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option>Semua Bank</option>
                    <option>BRI</option>
                    <option>SINARMAS</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option>Semua Status</option>
                    <option>Sudah Dibayar</option>
                    <option>Belum Dibayar</option>
                </select>
            </div>
        </div>
    </div>

    <button class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Buat gaji karyawan</button>
    <!-- Employee Cards -->
    <div class="row" id="employeeList">
        <div class="col-md-6">
            <div class="card" aria-hidden="true">
                <div class="card-body">
                    <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-6"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" aria-hidden="true">
                <div class="card-body">
                    <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-6"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat gaji karywan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formSubmit" action="{{ route('wms.finance.salary.store') }}" method="POST" data-reload="true">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="user_id">Pilih user</label>
                            <select name="user_id" id="user_id" class="form-select">
                                <option value="">--pilih user--</option>
                            </select>
                            <span class="text-danger" id="error-user_id"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Jumlah gaji</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="text" class="form-control" name="amount" id="amount"
                                    aria-describedby="basic-addon1">
                            </div>
                            <span class="text-danger" id="error-amount"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="get_sallary">Mendapat Gaji Bulanan</label>
                            <select name="get_sallary" id="get_sallary" class="form-select">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <span class="text-danger" id="error-get_sallary"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <x-btnLoading id="btnLoading" />
                        <x-btnSubmit id="btnSubmit" onclick="loading(true, 'btnSubmit', 'btnLoading')" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            getSalary();
            getUser();
        });

        async function getSalary() {
            let param = {
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    'load': 'get_salary'
                }
            }

            await transAjax(param).then((result) => {
                let data = result.metadata;
                $("#employeeList").html(html);
            }).catch((err) => {
                return alert('Gagal mengambil data user ' + err);
            });
        }
        async function getUser() {
            let param = {
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    'load': 'users'
                }
            }

            await transAjax(param).then((result) => {
                let data = result.metadata;
                $("#total_user").html(data.length);

                let html = '<option value="">--pilih user--</option>'
                data.forEach((item) => {
                    html += `
                    <option value="${item.id}">${item.name}</option>
                `
                });
                $("#user_id").html(html);
            }).catch((err) => {
                return alert('Gagal mengambil data user ' + err);
            })
        }

        const amountInput = document.getElementById('amount');

        amountInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, ""); // hanya angka
            if (value) {
                this.value = new Intl.NumberFormat("id-ID").format(value);
            } else {
                this.value = "";
            }
        });

        function edit(data) {
            $("#formSubmit").attr('action', '/wms/salary/update/' + data.id);
            $("#exampleModal").modal('show');

            // isi form sesuai data
            $('#user_id').val(data.user_id);
            $('#amount').val(data.amount); // format ke Rupiah
            $('#get_sallary').val(data.get_sallary);
        }
    </script>
@endpush
