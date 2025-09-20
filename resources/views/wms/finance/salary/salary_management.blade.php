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
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
    }
    
    .employee-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }
    
    .employee-header {
        background: linear-gradient(135deg,#2563eb, #3b82f6);
        color: white;
        padding: 1.5rem;
    }
    
    .salary-amount {
        font-size: 1.5rem;
        font-weight: bold;
        color:#2563eb;
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
        background-color:#2563eb;
        border-color:#2563eb;
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
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
                        <h2 class="card-number text-white" id="xendit_balance">
                            7
                            {{-- <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div> --}}
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

        <!-- Employee Cards -->
        <div class="row" id="employeeList">
            <!-- Umaedi Card -->
            <div class="col-lg-6 mb-4">
                <div class="employee-card">
                    <div class="employee-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="mb-1 text-white">
                                    <i class="fas fa-user-circle me-2"></i>
                                    Umaedi
                                </h5>
                                <small class="opacity-75">ID: 0199611f-9e80-7202-84ec-804df42d7292</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-3">
                        <div class="row align-items-center mb-3">
                            <div class="col">
                                <h6 class="text-muted mb-1">Gaji</h6>
                                <div class="salary-amount">Rp 18.000.000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave fa-2x text-success"></i>
                            </div>
                        </div>
                        
                        <div class="bank-info">
                            <h6 class="mb-2">
                                <i class="fas fa-university me-2"></i>
                                Informasi Bank
                            </h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <small class="text-muted">Nama Akun</small>
                                    <div class="fw-medium">Umaedi</div>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted">Bank</small>
                                    <div class="fw-medium">BRI</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">Nomor Rekening</small>
                                <div class="fw-medium font-monospace">869869697659759</div>
                            </div>
                        </div>
                        
                        <div class="action-buttons mt-3 text-center">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i>
                                Edit
                            </button>
                            <button class="btn btn-outline-success btn-sm">
                                <i class="fas fa-download me-1"></i>
                                Slip Gaji
                            </button>
                            <button class="btn btn-outline-info btn-sm">
                                <i class="fas fa-paper-plane me-1"></i>
                                Transfer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Erwin Card -->
            <div class="col-lg-6 mb-4">
                <div class="employee-card">
                    <div class="employee-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="mb-1 text-white">
                                    <i class="fas fa-user-circle me-2"></i>
                                    Erwin
                                </h5>
                                <small class="opacity-75">ID: 0199611f-2432-7051-888e-ac7349912b2b</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-3">
                        <div class="row align-items-center mb-3">
                            <div class="col">
                                <h6 class="text-muted mb-1">Gaji</h6>
                                <div class="salary-amount">Rp 280.000.000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave fa-2x text-success"></i>
                            </div>
                        </div>
                        
                        <div class="bank-info">
                            <h6 class="mb-2">
                                <i class="fas fa-university me-2"></i>
                                Informasi Bank
                            </h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <small class="text-muted">Nama Akun</small>
                                    <div class="fw-medium">Erwin Saputra</div>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted">Bank</small>
                                    <div class="fw-medium">SINARMAS</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">Nomor Rekening</small>
                                <div class="fw-medium font-monospace">0057544546</div>
                            </div>
                        </div>
                        
                        <div class="action-buttons mt-3 text-center">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i>
                                Edit
                            </button>
                            <button class="btn btn-outline-success btn-sm">
                                <i class="fas fa-download me-1"></i>
                                Slip Gaji
                            </button>
                            <button class="btn btn-outline-info btn-sm">
                                <i class="fas fa-paper-plane me-1"></i>
                                Transfer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sample data for reference
        const salaryData = {
            "code": 200,
            "success": true,
            "message": "Sallary List",
            "metadata": [
                {
                    "id": "0199611f-9e80-7202-84ec-804df42d7292",
                    "user_id": "2f04502b-ebe8-4f97-aa73-2471f4ff942b",
                    "user": "Umaedi",
                    "amount": "Rp 18.000.000",
                    "get_sallary": 1,
                    "bank": {
                        "account_name": "Umaedi",
                        "bank_account": "869869697659759",
                        "bank_code": "BRI"
                    }
                },
                {
                    "id": "0199611f-2432-7051-888e-ac7349912b2b",
                    "user_id": "019721de-6360-7057-8aa9-28f6c8fea8bc",
                    "user": "Erwin",
                    "amount": "Rp 280.000.000",
                    "get_sallary": 1,
                    "bank": {
                        "account_name": "Erwin Saputra",
                        "bank_account": "0057544546",
                        "bank_code": "SINARMAS"
                    }
                }
            ]
        };

        // Simple search functionality
        document.querySelector('input[placeholder="Cari nama karyawan..."]').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const employeeCards = document.querySelectorAll('.employee-card');
            
            employeeCards.forEach(card => {
                const employeeName = card.querySelector('h5').textContent.toLowerCase();
                const cardContainer = card.parentElement;
                
                if (employeeName.includes(searchTerm)) {
                    cardContainer.style.display = 'block';
                } else {
                    cardContainer.style.display = 'none';
                }
            });
        });

        // Add click handlers for action buttons
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn')) {
                const button = e.target.closest('.btn');
                const buttonText = button.textContent.trim();
                
                // Simple notification for demo purposes
                if (buttonText.includes('Edit')) {
                    alert('Fitur edit akan segera tersedia!');
                } else if (buttonText.includes('Slip Gaji')) {
                    alert('Mengunduh slip gaji...');
                } else if (buttonText.includes('Transfer')) {
                    alert('Memproses transfer...');
                } else if (buttonText.includes('Tambah Karyawan')) {
                    alert('Form tambah karyawan akan segera tersedia!');
                }
            }
        });
    </script>
@endsection