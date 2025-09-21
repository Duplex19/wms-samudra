@forelse ($data as $item)

 {{-- "id" => "01996b3a-cbef-7082-9405-3a57ce2522f7"
    "user_id" => "5e458f5c-df03-4504-aa57-d9fdd8172cf8"
    "user" => "Ian Edy"
    "amount" => "Rp 10.000.000"
    "get_sallary" => 1
    "bank" => array:3 [
      "account_name" => "EDI SIAGIAN"
      "bank_account" => "1140027804544"
      "bank_code" => "MANDIRI"
    ] --}}
    <!-- Umaedi Card -->
    <div class="col-lg-6 mb-4">
        <div class="employee-card">
            <div class="employee-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-1 text-white">
                            <i class="fas fa-user-circle me-2"></i>
                            {{ $item['user'] }}
                        </h5>
                        <small class="opacity-75">ID: {{ $item['id'] }}</small>
                    </div>
                </div>
            </div>
            
            <div class="p-3">
                <div class="row align-items-center mb-3">
                    <div class="col">
                        <h6 class="text-muted mb-1">Gaji</h6>
                        <div class="salary-amount">{{ $item['amount'] }}</div>
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
                            <div class="fw-medium">{{ $item['bank']['account_name'] }}</div>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted">Bank</small>
                            <div class="fw-medium">{{ $item['bank']['bank_code'] }}</div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">Nomor Rekening</small>
                        <div class="fw-medium font-monospace">{{ $item['bank']['bank_account'] }}</div>
                    </div>
                </div>
                
                <div class="action-buttons mt-3 text-center">
                    <button class="btn btn-outline-primary btn-sm" onclick='edit(@json($item))'>
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
    <script>
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
    </script>
@empty
    
@endforelse