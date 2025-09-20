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

        /* set pin */
        .set-pin-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .set-pin-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            outline: none;
        }

        .set-pin-input.filled {
            border-color: #0D46B4;
            background-color: #f8f9fa;
        }

        .set-pin-input.error {
            border-color: #dc3545;
            background-color: #fff5f5;
        }

        .set-pin-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 20px 0;
        }

        /* end set pin */

        .pin-input {
                width: 50px;
                height: 50px;
                text-align: center;
                font-size: 1.5rem;
                font-weight: bold;
                border: 2px solid #dee2e6;
                border-radius: 8px;
                margin: 0 5px;
                transition: all 0.3s ease;
            }

            .pin-input:focus {
                border-color: #0d6efd;
                box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
                outline: none;
            }

            .pin-input.filled {
                border-color: #0D46B4;
                background-color: #f8f9fa;
            }

            .pin-input.error {
                border-color: #dc3545;
                background-color: #fff5f5;
            }

            .pin-container {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 8px;
                margin: 20px 0;
            }

            /* .modal-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border-radius: 0.5rem 0.5rem 0 0;
            } */

            /* .modal-header .btn-close {
                filter: invert(1);
            } */

            .pin-dots {
                display: none;
            }

            .show-dots .pin-input {
                color: transparent;
            }

            .show-dots .pin-input.filled::before {
                content: "●";
                color: #495057;
                font-size: 1.2rem;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }

            .show-dots .pin-input {
                position: relative;
            }

            .toggle-visibility {
                background: none;
                border: none;
                color: #6c757d;
                font-size: 1.1rem;
                padding: 5px;
                cursor: pointer;
                transition: color 0.3s ease;
            }

            .toggle-visibility:hover {
                color: #495057;
            }

            .error-message {
                color: #dc3545;
                font-size: 0.875rem;
                margin-top: 10px;
                text-align: center;
            }

            .success-message {
                color: #0d46b4;
                font-size: 0.875rem;
                margin-top: 10px;
                text-align: center;
            }

            @media (max-width: 576px) {
                .pin-input {
                    width: 40px;
                    height: 40px;
                    font-size: 1.2rem;
                    margin: 0 3px;
                }

                .pin-container {
                    gap: 5px;
                }
            }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endpush
@section('content')
<div class="row">
    <div class="col-lg-6 col-md-4 col-12 mb-4">
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
                        <p class="card-label">{{ __('cms.team_salary') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="col-lg-6 col-md-6 col-12 mb-4">
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
                            <p class="card-label">{{ __('cms.team_balance') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">Informasi penting!</h4>
          <div>Pastikan anda sudah mengecek kembali data nominal gaji dan nomor rekening tujuan. Lakukan pembayaran dengan hahti-hati!</div>
        </div>
    </div>
</div>
<button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="{{ $user_pin == 'active' ? '#pinModal' :  '#pinInfoCreateModal' }}">{{ __('cms.pay_salary') }}</button>
<a href="{{ route('finance.salary.management') }}" class="btn btn-primary my-3">{{ __('cms.employee_salary_management') }} <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
<div class="card">
    <h5 class="card-header">Riwayat Gaji karyawan</h5>
    <div class="card-body">
        <div class="table-responsive">
                <table class="table table-sm text-nowrap" id="employeeSalaryHistory">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>{{ __('cms.name') }}</th>
                            <th>{{ __('cms.amount') }}</th>
                            <th>{{ __('cms.description') }}</th>
                            <th>{{ __('cms.date') }}</th>
                            <th>{{ __('cms.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <x-loadingTable /> --}}
                    </tbody>
                </table>
            </div>
    </div>
</div>


<!-- Modal konfirmasi pembuatan PIN -->
<div class="modal fade" id="pinInfoCreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <picture>
            <img src="{{ asset('assets/img/illustrations/pin.png') }}" alt="pin create" width="100%">
        </picture>
        <div class="text-center">
            <h5>Buat PIN Anda!</h5>
            <p>Untuk menjaga kemanan, Anda wajib membuat PIN terlebih dahulu</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinCreateModal">Buat PIN</button>
        </div>
      </div>
    </div>
  </div>
</div>


     <!-- PIN Modal -->
<div
    class="modal fade"
    id="pinCreateModal"
    tabindex="-1"
    aria-labelledby="pinModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form action="{{ route('wms.set-pin') }}" method="POST" data-table="false" data-reload="true">
            <div class="modal-body text-center py-4">
                <h5 class="modal-title" id="pinModalLabel">
                    <i class="fas fa-shield-alt me-2"></i>Buat PIN
                    Anda 
                </h5>
                <p class="text-muted mb-4">
                    Silakan masukkan 6 digit PIN untuk melanjutkan
                </p>

                <div class="pin-container" id="pinContainer">
                    <input
                        type="text"
                        class="form-control set-pin-input"
                        maxlength="1"
                        data-index="0"
                        inputmode="numeric"
                        name="pin[]"
                    />
                    <input
                        type="text"
                        class="form-control set-pin-input"
                        maxlength="1"
                        data-index="1"
                        inputmode="numeric"
                        name="pin[]"
                    />
                    <input
                        type="text"
                        class="form-control set-pin-input"
                        maxlength="1"
                        data-index="2"
                        inputmode="numeric"
                        name="pin[]"
                    />
                    <input
                        type="text"
                        class="form-control set-pin-input"
                        maxlength="1"
                        data-index="3"
                        inputmode="numeric"
                        name="pin[]"
                    />
                    <input
                        type="text"
                        class="form-control set-pin-input"
                        maxlength="1"
                        data-index="4"
                        inputmode="numeric"
                        name="pin[]"
                    />
                    <input
                        type="text"
                        class="form-control set-pin-input"
                        maxlength="1"
                        data-index="5"
                        inputmode="numeric"
                        name="pin[]"
                    />
                </div>

                <div id="messageContainer"></div>

                <div class="mt-4">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        PIN harus terdiri dari 6 digit angka
                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-warning"
                    data-bs-dismiss="modal"
                >
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                   <x-btnLoading id="btnLoading" />
                <button
                    type="submit"
                    class="btn btn-primary"
                    id="createPinBtn"
                    disabled
                    onclick="loading(true, 'createPinBtn', 'btnLoading', true)"
                >
                    <i class="fas fa-check me-2"></i>Buat PIN
                </button>
                <button
                    type="button"
                    class="btn btn-outline-primary"
                    onclick="clearPin()"
                >
                    <i class="fas fa-redo me-2"></i>Reset
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
     <!-- PIN Modal -->
<div
    class="modal fade"
    id="pinModal"
    tabindex="-1"
    aria-labelledby="pinModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                ></button>
            </div>
            <form action="{{ route('wms.finance.salary') }}" method="POST">
                @csrf
                <div class="modal-body text-center py-4">
                    <h5 class="modal-title" id="pinModalLabel">
                        <i class="fas fa-shield-alt me-2"></i>Masukkan PIN
                        Anda
                    </h5>
                    <p class="text-muted mb-4">
                        Silakan masukkan 6 digit PIN untuk melanjutkan
                    </p>

                    <div class="pin-container" id="pinContainer">
                        <input
                            type="password"
                            class="form-control pin-input"
                            maxlength="1"
                            data-index="0"
                            inputmode="numeric"
                            name="pin[]"
                        />
                        <input
                            type="password"
                            class="form-control pin-input"
                            maxlength="1"
                            data-index="1"
                            inputmode="numeric"
                            name="pin[]"
                        />
                        <input
                            type="password"
                            class="form-control pin-input"
                            maxlength="1"
                            data-index="2"
                            inputmode="numeric"
                            name="pin[]"
                        />
                        <input
                            type="password"
                            class="form-control pin-input"
                            maxlength="1"
                            data-index="3"
                            inputmode="numeric"
                            name="pin[]"
                        />
                        <input
                            type="password"
                            class="form-control pin-input"
                            maxlength="1"
                            data-index="4"
                            inputmode="numeric"
                            name="pin[]"
                        />
                        <input
                            type="password"
                            class="form-control pin-input"
                            maxlength="1"
                            data-index="5"
                            inputmode="numeric"
                            name="pin[]"
                        />
                    </div>

                    <div id="messageContainer"></div>

                    <div class="mt-4">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            PIN harus terdiri dari 6 digit angka
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-warning"
                        data-bs-dismiss="modal"
                    >
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                     <x-btnLoading id="btnLoadingVerifPin" />
                    <button
                        type="submit"
                        class="btn btn-primary"
                        id="verifyBtn"
                        disabled
                        onclick="loading(true, 'verifyBtn', 'btnLoadingVerifPin')"
                    >
                        <i class="fas fa-check me-2"></i>Verifikasi PIN
                    </button>
                    <button
                        type="button"
                        class="btn btn-outline-primary"
                        onclick="clearPin()"
                    >
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </div>
        </form>
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

        dataTable = $('#employeeSalaryHistory').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url()->current() }}',
        },
        columns: [
            { 
            data: null,
            name: 'No',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'user', name: 'user' },
            { data: 'amount', name: 'amount' },
            { data: 'description', name: 'description'},
            { data: 'date', name: 'date'},
            { data: 'status', name: 'status', render: function(data) {
               let badgeClass = 'bg-secondary'; 
                if (data.toLowerCase() === 'success') {
                    badgeClass = 'bg-success';
                } else if (data.toLowerCase() === 'failed') {
                    badgeClass = 'bg-danger';
                }
                return `<span class="badge ${badgeClass} rounded-pill">${data}</span>`;
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
        <script>
            let currentPin = "";
            let isVisible = false;

            document.addEventListener("DOMContentLoaded", function () {
                const setPinInputs = document.querySelectorAll(".set-pin-input");
                const pinInputs = document.querySelectorAll(".pin-input");

                //SET PIN INPUT
                setPinInputs.forEach((input, index) => {
                    input.addEventListener("input", function (e) {
                        handleSetPinInput(e, index);
                    });

                    input.addEventListener("keydown", function (e) {
                        handleKeyDown(e, index);
                    });

                    input.addEventListener("paste", function (e) {
                        handlePaste(e);
                    });
                });
                //END SE PIN INPUT

                pinInputs.forEach((input, index) => {
                    input.addEventListener("input", function (e) {
                        handlePinInput(e, index);
                    });

                    input.addEventListener("keydown", function (e) {
                        handleKeyDown(e, index);
                    });

                    input.addEventListener("paste", function (e) {
                        handlePaste(e);
                    });
                });
            });

            //HANDLE SET PIN INPUT
            function handleSetPinInput(e, index) {
                const value = e.target.value;
                const pinInputs = document.querySelectorAll(".set-pin-input");

                // Hanya izinkan angka
                if (!/^\d*$/.test(value)) {
                    e.target.value = "";
                    return;
                }

                if (value.length === 1) {
                    e.target.classList.add("filled");
                    e.target.classList.remove("error");

                    // Pindah ke input berikutnya
                    if (index < 5) {
                        pinInputs[index + 1].focus();
                    }
                } else if (value.length === 0) {
                    e.target.classList.remove("filled", "error");
                }

                updateSetPin();
            }
            //END SET PIN INPUT

            function handlePinInput(e, index) {
                const value = e.target.value;
                const pinInputs = document.querySelectorAll(".pin-input");

                // Hanya izinkan angka
                if (!/^\d*$/.test(value)) {
                    e.target.value = "";
                    return;
                }

                if (value.length === 1) {
                    e.target.classList.add("filled");
                    e.target.classList.remove("error");

                    // Pindah ke input berikutnya
                    if (index < 5) {
                        pinInputs[index + 1].focus();
                    }
                } else if (value.length === 0) {
                    e.target.classList.remove("filled", "error");
                }

                updatePin();
            }

            //HANDLE KEY DOWN SET PIN INPUT
            function handleKeyDownSetInput(e, index) {
                const pinInputs = document.querySelectorAll(".set-pin-input");

                if (
                    e.key === "Backspace" &&
                    e.target.value === "" &&
                    index > 0
                ) {
                    pinInputs[index - 1].focus();
                    pinInputs[index - 1].value = "";
                    pinInputs[index - 1].classList.remove("filled", "error");
                    updatePin();
                } else if (e.key === "ArrowLeft" && index > 0) {
                    pinInputs[index - 1].focus();
                } else if (e.key === "ArrowRight" && index < 5) {
                    pinInputs[index + 1].focus();
                }
            }
            //END HANDLE KEY DOWN SET INPUT

            function handleKeyDown(e, index) {
                const pinInputs = document.querySelectorAll(".pin-input");

                if (
                    e.key === "Backspace" &&
                    e.target.value === "" &&
                    index > 0
                ) {
                    pinInputs[index - 1].focus();
                    pinInputs[index - 1].value = "";
                    pinInputs[index - 1].classList.remove("filled", "error");
                    updatePin();
                } else if (e.key === "ArrowLeft" && index > 0) {
                    pinInputs[index - 1].focus();
                } else if (e.key === "ArrowRight" && index < 5) {
                    pinInputs[index + 1].focus();
                }
            }

            function handlePaste(e) {
                e.preventDefault();
                const pastedData = e.clipboardData.getData("text");
                const numbers = pastedData.replace(/\D/g, "").slice(0, 6);

                if (numbers.length > 0) {
                    const pinInputs = document.querySelectorAll(".pin-input");
                    for (let i = 0; i < numbers.length; i++) {
                        if (pinInputs[i]) {
                            pinInputs[i].value = numbers[i];
                            pinInputs[i].classList.add("filled");
                            pinInputs[i].classList.remove("error");
                        }
                    }
                    if (numbers.length < 6) {
                        pinInputs[numbers.length].focus();
                    }
                    updatePin();
                }
            }

            //HANLDE UPDATE SET PIN
             function updateSetPin() {
                const pinInputs = document.querySelectorAll(".set-pin-input");
                currentPin = "";

                pinInputs.forEach((input) => {
                    currentPin += input.value || "";
                });

                const createPinBtn = document.getElementById("createPinBtn");
                createPinBtn.disabled = currentPin.length !== 6;

                clearMessage();
            }
            //END HANDLE UPDATE PIN

            function updatePin() {
                const pinInputs = document.querySelectorAll(".pin-input");
                currentPin = "";

                pinInputs.forEach((input) => {
                    currentPin += input.value || "";
                });

                const verifyBtn = document.getElementById("verifyBtn");
                verifyBtn.disabled = currentPin.length !== 6;

                clearMessage();
            }

            function togglePinVisibility() {
                const pinInputs = document.querySelectorAll(".pin-input");
                const toggleIcon = document.getElementById("toggleIcon");
                const container = document.getElementById("pinContainer");

                isVisible = !isVisible;

                if (isVisible) {
                    pinInputs.forEach((input) => {
                        input.type = "text";
                    });
                    toggleIcon.className = "fas fa-eye-slash";
                    container.classList.remove("show-dots");
                } else {
                    pinInputs.forEach((input) => {
                        input.type = "password";
                    });
                    toggleIcon.className = "fas fa-eye";
                    container.classList.add("show-dots");
                }
            }

            function clearPin() {
                const setPinInputs = document.querySelectorAll(".set-pin-input");
                const pinInputs = document.querySelectorAll(".pin-input");
                const verifyBtn = document.getElementById("verifyBtn");

                setPinInputs.forEach((input) => {
                    input.value = "";
                    input.classList.remove("filled", "error");
                });

                currentPin = "";
                verifyBtn.disabled = true;
                clearMessage();
                setPinInputs[0].focus();

                pinInputs.forEach((input) => {
                    input.value = "";
                    input.classList.remove("filled", "error");
                });

                currentPin = "";
                verifyBtn.disabled = true;
                clearMessage();
                pinInputs[0].focus();
            }

            function clearMessage() {
                const messageContainer =
                    document.getElementById("messageContainer");
                messageContainer.innerHTML = "";
            }

            // Reset PIN ketika modal dibuka
            document
                .getElementById("pinModal")
                .addEventListener("shown.bs.modal", function () {
                    clearPin();
                });
        </script>
@endpush