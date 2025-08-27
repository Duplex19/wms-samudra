@extends('layouts.app')
@push('css')
    <style>
        .step-progress {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .step-item {
            position: relative;
            flex: 1;
            text-align: center;
        }
        
        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 15px;
            right: -50%;
            width: 100%;
            height: 2px;
            background: #dee2e6;
            z-index: 1;
        }
        
        .step-item.active:not(:last-child)::after,
        .step-item.completed:not(:last-child)::after {
            background: #0d6efd;
        }
        
        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #dee2e6;
            color: #6c757d;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }
        
        .step-item.active .step-circle {
            background: #0d6efd;
            color: white;
        }
        
        .step-item.completed .step-circle {
            background: #198754;
            color: white;
        }
        
        .step-label {
            font-size: 12px;
            margin-top: 8px;
            color: #6c757d;
            font-weight: 500;
        }
        
        .step-item.active .step-label,
        .step-item.completed .step-label {
            color: #495057;
            font-weight: 600;
        }
        
        .form-step {
            display: none;
        }
        
        .form-step.active {
            display: block;
        }
        
        .btn-step {
            min-width: 100px;
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        
        .section-title {
            color: #495057;
            font-weight: 600;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }
    </style>
@endpush
@section('content')
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addVpnServer"><i
            class="menu-icon icon-base bx bx-user"></i>
        Tambah user</button>
    <div class="row mb-12 g-6" id="team">
        <div class="col-md-4">
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
                    <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
                    <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
                    <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
   <!-- Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-user-edit me-2"></i>Edit User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="updateUser" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    <div class="modal-body">
                        <!-- Step Progress -->
                        <div class="step-progress">
                            <div class="d-flex justify-content-between">
                                <div class="step-item active" data-step="1">
                                    <div class="step-circle">1</div>
                                    <div class="step-label">Info Dasar</div>
                                </div>
                                <div class="step-item" data-step="2">
                                    <div class="step-circle">2</div>
                                    <div class="step-label">Detail User</div>
                                </div>
                                <div class="step-item" data-step="3">
                                    <div class="step-circle">3</div>
                                    <div class="step-label">Akun Bank</div>
                                </div>
                                <div class="step-item" data-step="4">
                                    <div class="step-circle">4</div>
                                    <div class="step-label">Review</div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 1: Info Dasar -->
                        <div class="form-step active fade-in" id="step-1">
                            <h6 class="section-title">
                                <i class="fas fa-info-circle me-2"></i>Informasi Dasar
                            </h6>
                            
                            <div class="form-group mb-3">
                                <label for="team_management_id" class="form-label">
                                    <i class="fas fa-users me-1"></i>Manajemen Tim
                                </label>
                                <select class="form-select" name="team_management_id" id="team_management_id" onchange="handleTeam(this.value)">
                                   
                                </select>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="team" class="form-label">
                                    <i class="fas fa-user-friends me-1"></i>Nama Tim
                                </label>
                                <input type="text" class="form-control" name="nama_team" id="nama_team" placeholder="Masukkan nama tim">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nama Lengkap
                                </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>

                        <!-- Step 2: Detail User -->
                        <div class="form-step" id="step-2">
                            <h6 class="section-title">
                                <i class="fas fa-id-card me-2"></i>Detail User
                            </h6>
                            
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>Email
                                </label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="contoh@email.com" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="whatsapp" class="form-label">
                                    <i class="fab fa-whatsapp me-1"></i>Nomor WhatsApp
                                </label>
                                <input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="08xxxxxxxxxx" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-1"></i>Password
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Kosongkan jika tidak ingin mengubah">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jabatan" class="form-label">
                                            <i class="fas fa-briefcase me-1"></i>Jabatan
                                        </label>
                                        <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Masukkan jabatan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="role" class="form-label">
                                            <i class="fas fa-user-tag me-1"></i>Role
                                        </label>
                                        <select class="form-select" name="role" id="role" required>
                                            <option value="">Pilih role...</option>
                                            <option value="admin">Admin</option>
                                            <option value="management">Management</option>
                                            <option value="teknisi">Teknisi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="foto" class="form-label">
                                    <i class="fas fa-camera me-1"></i>Foto Profil
                                </label>
                                <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                <div class="form-text">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.</div>
                            </div>
                        </div>

                        <!-- Step 3: Akun Bank -->
                        <div class="form-step" id="step-3">
                            <h6 class="section-title">
                                <i class="fas fa-university me-2"></i>Informasi Akun Bank
                            </h6>
                            
                            <div class="form-group mb-3">
                                <label for="namaPemilikRekening" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nama Pemilik Rekening
                                </label>
                                <input type="text" class="form-control" id="namaPemilikRekening" name="nama_pemilik" placeholder="Masukkan nama sesuai rekening">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="bank_code" class="form-label">
                                    <i class="fas fa-building me-1"></i>Nama Bank
                                </label>
                                <select class="form-select"  name="bank_code" id="bank_code">
                                    <option value="">Pilih bank...</option>
                                    <option value="BCA">Bank Central Asia (BCA)</option>
                                    <option value="BRI">Bank Rakyat Indonesia (BRI)</option>
                                    <option value="BNI">Bank Negara Indonesia (BNI)</option>
                                    <option value="MANDIRI">Bank Mandiri</option>
                                    <option value="CIMB">CIMB Niaga</option>
                                    <option value="DANAMON">Bank Danamon</option>
                                    <option value="PERMATA">Bank Permata</option>
                                </select>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="norek" class="form-label">
                                    <i class="fas fa-credit-card me-1"></i>Nomor Rekening
                                </label>
                                <input type="text" class="form-control" name="norek" id="norek" placeholder="Masukkan nomor rekening">
                            </div>
                        </div>

                        <!-- Step 4: Review -->
                        <div class="form-step" id="step-4">
                            <h6 class="section-title">
                                <i class="fas fa-check-circle me-2"></i>Review Data
                            </h6>
                            <div class="row" id="reviewData">
                            </div>
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Pastikan semua data sudah benar sebelum menyimpan. Anda dapat kembali ke step sebelumnya untuk melakukan perubahan.
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between w-100">
                            <button type="button" class="btn btn-secondary btn-step" id="prevBtn" style="display: none;">
                                <i class="fas fa-arrow-left me-1"></i>Sebelumnya
                            </button>
                            <div class="ms-auto">
                                <button type="button" class="btn btn-primary btn-step" id="nextBtn">
                                    Selanjutnya<i class="fas fa-arrow-right ms-1"></i>
                                </button>
                                <button type="submit" class="btn btn-primary btn-step" id="submitBtn" style="display: none;">
                                    <i class="fas fa-save me-1"></i>Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function() {
            getData();
            new MultiStepForm();
        });

        async function getData()
        {
            let param = {
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    "category": "users"
                }
            }

            await transAjax(param).then((result) => {
                $("#team").html(result);
            }).catch((err) => {
                console.log(err);
            });
        };

        function editUser(user) {
            $("#updateUser").attr('action', '/wms/users/update/' + user.id);
            $("input[name=name]").val(user.name)
            $("input[name=email]").val(user.email)
            $("input[name=role]").val(user.role)
            $("input[name=whatsapp]").val(user.whatsapp)
            $("input[name=jabatan]").val(user.jabatan)
            $("input[name=nama_team]").val(user.team)
          
            //akun bank
            $("#namaPemilikRekening").val(user.bank.account_name)
            $("input[name=bank_code]").val(user.bank.bank_code)
            $("input[name=norek]").val(user.bank.account_number)
            $("#editUser").modal('show');
            getTeam(user.team_id);
        }

        async function getTeam(teamId)
        {
            let param = {
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    "category": "team"
                }
            }

            await transAjax(param).then((result) => {
            let data = result.metadata;
            let html = '<option value="">Pilih manajemen tim...</option>';

            data.forEach((item) => {
                html += `
                <option value="${item.id}" ${item.id == teamId ? 'selected' : ''}>${item.nama_team}</option>
                `
            });
            $('#team_management_id').html(html);

            }).catch((err) => {
                console.log(err);
            });
        }

        class MultiStepForm {
            constructor() {
                this.currentStep = 1;
                this.totalSteps = 4;
                this.init();
            }

            init() {
                this.bindEvents();
                this.updateButtons();
            }

            bindEvents() {
                document.getElementById('nextBtn').addEventListener('click', () => this.nextStep());
                document.getElementById('prevBtn').addEventListener('click', () => this.prevStep());
                
                // Toggle password visibility
                document.getElementById('togglePassword').addEventListener('click', this.togglePasswordVisibility);
                
                // Auto-fill nama pemilik rekening from nama
                document.getElementById('name').addEventListener('input', (e) => {
                    document.getElementById('namaPemilikRekening').value = e.target.value;
                });
            }

            nextStep() {
                if (this.validateCurrentStep()) {
                    if (this.currentStep < this.totalSteps) {
                        this.showStep(this.currentStep + 1);
                    }
                }
            }

            prevStep() {
                if (this.currentStep > 1) {
                    this.showStep(this.currentStep - 1);
                }
            }

            showStep(stepNumber) {
                // Hide current step
                document.getElementById(`step-${this.currentStep}`).classList.remove('active');
                
                // Show new step
                this.currentStep = stepNumber;
                const newStep = document.getElementById(`step-${this.currentStep}`);
                newStep.classList.add('active');
                newStep.classList.add('fade-in');
                
                // Update progress
                this.updateProgress();
                this.updateButtons();
                
                // Update review data if on step 4
                if (this.currentStep === 4) {
                    this.updateReviewData();
                }
                
                // Remove fade-in class after animation
                setTimeout(() => {
                    newStep.classList.remove('fade-in');
                }, 300);
            }

            updateProgress() {
                const steps = document.querySelectorAll('.step-item');
                
                steps.forEach((step, index) => {
                    const stepNumber = index + 1;
                    step.classList.remove('active', 'completed');
                    
                    if (stepNumber < this.currentStep) {
                        step.classList.add('completed');
                    } else if (stepNumber === this.currentStep) {
                        step.classList.add('active');
                    }
                });
            }

            updateButtons() {
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                const submitBtn = document.getElementById('submitBtn');

                // Show/hide previous button
                prevBtn.style.display = this.currentStep > 1 ? 'block' : 'none';

                // Show/hide next and submit buttons
                if (this.currentStep === this.totalSteps) {
                    nextBtn.style.display = 'none';
                    submitBtn.style.display = 'block';
                } else {
                    nextBtn.style.display = 'block';
                    submitBtn.style.display = 'none';
                }
            }

            validateCurrentStep() {
                const currentStepElement = document.getElementById(`step-${this.currentStep}`);
                const requiredFields = currentStepElement.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                        
                        // Remove invalid class after user starts typing
                        field.addEventListener('input', function() {
                            this.classList.remove('is-invalid');
                        }, { once: true });
                    }
                });

                if (!isValid) {
                    this.showAlert('Mohon lengkapi semua field yang wajib diisi!', 'warning');
                }

                return isValid;
            }

            updateReviewData() {
                const formData = new FormData(document.getElementById('updateUser'));
                const reviewContainer = document.getElementById('reviewData');
                
                const sections = [
                    {
                        title: 'Informasi Dasar',
                        icon: 'fas fa-info-circle',
                        fields: [
                            { label: 'Manajemen Tim', name: 'team_management_id' },
                            { label: 'Nama Tim', name: 'team' },
                            { label: 'Nama Lengkap', name: 'name' }
                        ]
                    },
                    {
                        title: 'Detail User',
                        icon: 'fas fa-id-card',
                        fields: [
                            { label: 'Email', name: 'email' },
                            { label: 'WhatsApp', name: 'whatsapp' },
                            { label: 'Jabatan', name: 'jabatan' },
                            { label: 'Role', name: 'role' }
                        ]
                    },
                    {
                        title: 'Akun Bank',
                        icon: 'fas fa-university',
                        fields: [
                            { label: 'Nama Pemilik', name: 'nama_pemilik' },
                            { label: 'Bank', name: 'bank_code' },
                            { label: 'No. Rekening', name: 'norek' }
                        ]
                    }
                ];

                let html = '';
                sections.forEach(section => {
                    html += `
                        <div class="col-12 mb-3">
                            <h6 class="text-primary mb-2">
                                <i class="${section.icon} me-2"></i>${section.title}
                            </h6>
                            <div class="row">
                    `;
                    
                    section.fields.forEach(field => {
                        let value = formData.get(field.name) || '-';
                        if (field.name === 'team_management_id') {
                            const select = document.querySelector(`[name="${field.name}"]`);
                            value = select.options[select.selectedIndex]?.text || '-';
                        } else if (field.name === 'bank_code') {
                            const select = document.querySelector(`[name="${field.name}"]`);
                            value = select.options[select.selectedIndex]?.text || '-';
                        } else if (field.name === 'role') {
                            const select = document.querySelector(`[name="${field.name}"]`);
                            value = select.options[select.selectedIndex]?.text || '-';
                        }
                        
                        html += `
                            <div class="col-md-6 mb-2">
                                <small class="text-muted">${field.label}:</small><br>
                                <strong>${value}</strong>
                            </div>
                        `;
                    });
                    
                    html += `
                            </div>
                        </div>
                    `;
                });

                reviewContainer.innerHTML = html;
            }

            togglePasswordVisibility() {
                const passwordField = document.getElementById('password');
                const toggleButton = document.getElementById('togglePassword');
                const icon = toggleButton.querySelector('i');
                
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            }

            resetForm() {
                this.currentStep = 1;
                this.showStep(1);
                document.getElementById('updateUser').reset();
            }
        }

        // Reset form when modal is closed
        document.getElementById('editUser').addEventListener('hidden.bs.modal', function() {
            const form = new MultiStepForm();
            form.resetForm();
        });
        
        function handleTeam()
        {
            $('#nama_team').prop('disabled', true);
        }
    </script>
@endpush
