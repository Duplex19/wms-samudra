@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header" id="textHeader">Tambah router</h5>
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </symbol>
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </symbol>
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>
                        </svg>
                    <p><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg> Untuk kolom IP, gunakan IP public atau IP client dari <a href="{{ route('wms.vpn') }}">VPN Server <i class="bx bx-link-external"></i></a></p>
                    </div>
                    <form id="formAction" action="{{ route('wms.router.store') }}" method="POST" data-table="true">
                        @csrf
                        <div class="form-group mb-3">
                        <label for="">Nama*</label>
                        <input type="text" class="form-control" name="name">
                        <span class="text-danger" id="error-name"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">IP*</label>
                            <input type="text" class="form-control" name="ip">
                             <span class="text-danger" id="error-ip"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Port (opsional)</label>
                            <input type="text" class="form-control" name="port" placeholder="8728">
                             <span class="text-danger" id="error-port"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Nama pengguna*</label>
                            <input type="text" class="form-control" name="username">
                             <span class="text-danger" id="error-username"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password*</label>
                            <input type="text" class="form-control" name="password">
                            <span class="text-danger" id="error-password"></span>
                        </div>
                        <x-btnLoading id="btnLoading" />
                        <x-btnSubmit id="btnSubmit" onclick="loading(true, 'btnSubmit', 'btnLoading', true)" />
                    </form>
                </div>
            </div>
        </div>
        <x-loadingPopup id="loadingOverlay" />
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">List data router</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="dataTable" class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">IP</th>
                                <th scope="col">Port</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <x-loadingTable colspan="8" />
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            dataTable = $('#dataTable').DataTable({
                // processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url()->current() }}",
                    data: function(d) {
                        d.status = $('#filterStatus').val();
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
                    {data: 'name', name: 'name'},
                    {data: 'ip', name: 'ip'},
                    {data: 'port', name: 'port'},
                    {data: 'status', name: 'status', render: function(data, type, row) {
                        let badgeClass = 'bg-danger'; 
                        if (data.toLowerCase() === 'connected') {
                            badgeClass = 'bg-success';
                        } else if (data.toLowerCase() === 'pending') {
                            badgeClass = 'bg-warning';
                        }
                        return `
                            <span class="badge ${badgeClass} rounded-pill cursor-pointer">${row.status}</span>
                        `;
                    }},
                    {   
                    data: null,
                    name: 'aksi',
                    orderable: false,
                    searchable: false,
                        render: function(data, type, row) {
                            return `
                                <span class="btn btn-primary btn-sm" onclick="connectionTest('${row.id}')"><i class='bx ${row.status === 'connected' ? 'bx-link' : 'bx-unlink'}'></i></span>
                                <span class="btn btn-warning btn-sm" onclick='edit(${JSON.stringify(row)})'><i class='bx bx-edit'></i></span>
                                <span class="btn btn-danger btn-sm" onclick="hapus('/wms/config/router/delete/${row.id}')"><i class='bx bx-trash'></i></span>
                            `;
                        }
                    }
                ],
                order: [[0, 'asc']],
                pageLength: 10,
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                language: {
                    processing: '<i class="fas fa-spinner fa-spin"></i> Loading...',
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    loadingRecords: "Memuat data...",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    emptyTable: "Tidak ada data yang tersedia",
                    paginate: {
                        first: '<i class="fas fa-angle-double-left"></i>',
                        previous: '<i class="fas fa-angle-left"></i>',
                        next: '<i class="fas fa-angle-right"></i>',
                        last: '<i class="fas fa-angle-double-right"></i>'
                    }
                }
            });

            // Filter functionality
            $('#filterStatus').on('change keyup', function() {
                dataTable.draw();
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
        });
        

        function edit(value)
        {
            let {id, name, ip, port, status, username} = value;
            $("#formAction").attr('action','/wms/config/router/update/' + id);

            $("#textHeader").text('Update router');
            $('input[name="name"]').val(name);
            $('input[name="ip"]').val(ip);
            $('input[name="port"]').val(port);
            $('input[name="status"]').val(status);
            $('input[name="username"]').val(username);
            $("#btnSubmit").text('Upadate');
        }

        async function connectionTest(id)
        {
            $("#loadingOverlay").removeClass('d-none');

            let param = {
                url: '/wms/config/router/connection_check/'+id,
                method: 'POST'
            };

            await transAjax(param).then((result) => {
                $("#loadingOverlay").addClass('d-none');

                console.log(result.message);
                swal({ 
                    title: 'Berhasil',
                    text:  result.message, 
                    icon: 'success', 
                });
            }).catch((err) => {
                $("#loadingOverlay").addClass('d-none');
                if(err.status === 401) {
                    swal({ 
                        title: 'Sesi habis',
                        text:  err.responseJSON.message, 
                        icon: 'error', 
                        timer: 3000,
                    }).then(() => {
                        window.location.href = '/';
                    });
                }else {
                    swal({ 
                        title: 'Gagal',
                        text:  err.responseJSON.message, 
                        icon: 'error', 
                    });
                }                
            });
            dataTable.ajax.reload();
        }
    </script>
@endpush