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
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
@endpush
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-user-plus"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white">852</h2>
                        <p class="card-label">Total</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-user-check"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white">835</h2>
                        <p class="card-label">Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-user-x"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white">17</h2>
                        <p class="card-label">Ditangguhkan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-user-voice"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white">799</h2>
                        <p class="card-label">Online</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
       <div class="filter-section">
            <h6><i class="fas fa-filter me-2"></i>Filter Data</h6>
                <div class="row">
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Gender</label>
                        <select class="form-select" id="genderFilter">
                            <option value="">All Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">City</label>
                        <select class="form-select" id="cityFilter">
                            <option value="">All Cities</option>
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Min Age</label>
                        <input type="number" class="form-control" id="minAgeFilter" placeholder="Min Age">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Max Age</label>
                        <input type="number" class="form-control" id="maxAgeFilter" placeholder="Max Age">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid">
                            <button class="btn btn-outline-secondary" id="resetFilters">
                                <i class="fas fa-times"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mb-3">
                <button class="btn btn-outline-primary mb-3"><i class="tf-icons bx bx-user-plus"></i> Tambah pengguna</button>
                <button class="btn btn-outline-primary mb-3"><i class="tf-icons bx bx-cog"></i></button>
                <button class="btn btn-outline-primary mb-3"><i class="tf-icons bx bx-slider"></i></button>
                <button button class="btn btn-outline-primary mb-3"><i class="tf-icons bx bx-trash"></i></button>
            </div>

            <!-- DataTable -->
            <div class="table-responsive">
                <table id="usersTable" class="table table-sm text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>City</th>
                            {{-- <th>Birth Date</th>
                            <th>Age</th>
                            <th>Created At</th>
                            <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        // Initialize DataTable
            let table = $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url()->current() }}",
                    data: function(d) {
                        d.status = $('#statusFilter').val();
                        d.gender = $('#genderFilter').val();
                        d.city = $('#cityFilter').val();
                        d.min_age = $('#minAgeFilter').val();
                        d.max_age = $('#maxAgeFilter').val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'gender', name: 'gender'},
                    {data: 'status', name: 'status'},
                    {data: 'city', name: 'city'},
                ],
                order: [[0, 'asc']],
                pageLength: 10,
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                language: {
                    processing: '<i class="fas fa-spinner fa-spin"></i> Loading...',
                    search: '<i class="fas fa-search"></i>',
                    lengthMenu: 'Show _MENU_ entries',
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                    paginate: {
                        first: '<i class="fas fa-angle-double-left"></i>',
                        previous: '<i class="fas fa-angle-left"></i>',
                        next: '<i class="fas fa-angle-right"></i>',
                        last: '<i class="fas fa-angle-double-right"></i>'
                    }
                }
            });

            // Filter functionality
            $('#statusFilter, #genderFilter, #cityFilter, #minAgeFilter, #maxAgeFilter').on('change keyup', function() {
                table.draw();
            });

            // Reset filters
            $('#resetFilters').click(function() {
                $('#statusFilter, #genderFilter, #cityFilter, #minAgeFilter, #maxAgeFilter').val('');
                table.draw();
            });

            // Refresh table
            $('#refreshTable').click(function() {
                table.ajax.reload();
            });

            // Add user
            $('#addUserBtn').click(function() {
                $('#userForm')[0].reset();
                $('#userId').val('');
                $('#userModalLabel').text('Add New User');
                $('#passwordField').show();
                $('#password').attr('required', true);
                $('#userModal').modal('show');
            });

            // Submit form
            $('#userForm').submit(function(e) {
                e.preventDefault();
                
                let userId = $('#userId').val();
                let url = userId ? "#".replace(':id', userId) : "#";
                let method = userId ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#userModal').modal('hide');
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        for (let key in errors) {
                            errorMessage += errors[key][0] + '\n';
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage
                        });
                    }
                });
            });

        // Edit user function
        function editUser(id) {
            $.ajax({
                url: "#".replace(':id', id),
                method: 'GET',
                success: function(user) {
                    $('#userId').val(user.id);
                    $('#name').val(user.name);
                    $('#email').val(user.email);
                    $('#phone').val(user.phone);
                    $('#gender').val(user.gender);
                    $('#status').val(user.status);
                    $('#city').val(user.city);
                    $('#birth_date').val(user.birth_date);
                    $('#userModalLabel').text('Edit User');
                    $('#passwordField').hide();
                    $('#password').removeAttr('required');
                    $('#userModal').modal('show');
                }
            });
        }

        // Delete user function
        function deleteUser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "#".replace(':id', id),
                        method: 'DELETE',
                        success: function(response) {
                            $('#usersTable').DataTable().ajax.reload();
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush