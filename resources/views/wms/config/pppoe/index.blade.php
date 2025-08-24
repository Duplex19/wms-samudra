@extends('layouts.app')
@push('css')
    <style>
        /* Belum dibuka */
        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
            content: "\f0fe" !important;
            /* fa-plus-square */
            font-family: "Font Awesome 6 Free";
            /* sesuaikan dengan versimu */
            font-weight: 900;
        }

        /* Sudah dibuka */
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td.dtr-control:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th.dtr-control:before {
            content: "\f146" !important;
            /* fa-minus-square */
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
        }
    </style>
@endpush
@section('content')
    <div class="col-md-12">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPppoe"><i
                class="tf-icons bx bx-user-plus"></i>{{ __('cms.add_ppoe') }}</button>
        <button class="btn btn-primary mb-3"><i class="tf-icons bx bx-cog"></i></button>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#filter"><i
                class="tf-icons bx bx-slider"></i></button>
        <button class="btn btn-primary mb-3"><i class="tf-icons bx bx-trash"></i></button>
        <div class="card">
            <h5 class="card-header">List data pppoe</h5>
            <div class="card-body">
                <div class="table-responsive mt-2">
                    <table id="dataTable" class="table table-sm text-nowrap">
                        <thead class="filter-section">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">{{ __('cms.name') }}</th>
                                <th scope="col"{{ __('cms.username') }}</th>
                                <th scope="col">Password</th>
                                <th scope="col">{{ __('cms.sidebar_profile') }}</th>
                                <th scope="col">Router</th>
                                <th scope="col">IP</th>
                                <th scope="col">Status</th>
                                <th scope="col">Internet</th>
                                <th scope="col">{{ __('cms.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <x-loadingTable colspan="12" />
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal add PPPOE -->
        <div class="modal fade" id="addPppoe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah pppoe</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form id="formAction" action="{{ route('wms.pppoe.store') }}" method="POST" data-table="true">
                                @csrf
                                <div class="row g-3">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Router*</label>
                                            <select name="router_id" id="router_id" class="form-select router">
                                                <option>--pilih router--</option>
                                            </select>
                                            <span class="text-danger" id="error-router_id"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Profil PPP*</label>
                                            <select name="profile_ppp_id" id="profile_ppp_id" class="form-select profile">
                                                <option>--pilih profil ppp--</option>
                                            </select>
                                            <span class="text-danger" id="error-profile_ppp_id"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Nama pengguna*</label>
                                            <input type="text" class="form-control" name="username">
                                            <span class="text-danger" id="error-username"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Password*</label>
                                            <input type="text" class="form-control" name="password">
                                            <span class="text-danger" id="error-password"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Nama*</label>
                                            <input type="text" class="form-control" name="name">
                                            <span class="text-danger" id="error-name"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">No WhatsApp*</label>
                                            <input type="text" class="form-control" name="whatsapp">
                                            <span class="text-danger" id="error-whatsapp"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Alamat*</label>
                                            <input name="address" class="form-control"></input>
                                            <span class="text-danger" id="error-address"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Tanggal aktif*</label>
                                            <input type="date" name="active_date" class="form-control"></input>
                                            <span class="text-danger" id="error-active_date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Metode pembayaran*</label>
                                            <select name="payment_type" id="payment_type" class="form-select">
                                                <option>--pilih metode pembayaran--</option>
                                                <option value="postpaid">Postpaid</option>
                                                <option value="prepaid">Prepaid</option>
                                            </select>
                                            <span class="text-danger" id="error-payment_type"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Status*</label>
                                            <select name="status" id="status" class="form-select">
                                                <option value="">--pilih status--</option>
                                                <option value="active">Aktif</option>
                                                <option value="inactive">Tdk aktif</option>
                                            </select>
                                            <span class="text-danger" id="error-status"></span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <x-btnLoading id="btnLoading" />
                        <x-btnSubmit id="btnSubmit" onclick="loading(true, 'btnSubmit', 'btnLoading', true)" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editPppoe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit pppoe</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form id="formUpdate" action="#" method="POST" data-table="true">
                                @csrf
                                <div class="row g-3">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Router*</label>
                                            <select name="router_id" id="router_id" class="form-select router">
                                                <option>--pilih router--</option>
                                            </select>
                                            <span class="text-danger" id="error-router_id"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Profil PPP*</label>
                                            <select name="profile_ppp_id" id="profile_ppp_id"
                                                class="form-select profile">
                                                <option>--pilih profil ppp--</option>
                                            </select>
                                            <span class="text-danger" id="error-profile_ppp_id"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Nama pengguna*</label>
                                            <input type="text" class="form-control" id="username" name="username">
                                            <span class="text-danger" id="error-username"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="">Password*</label>
                                            <input type="text" class="form-control" id="password" name="password">
                                            <span class="text-danger" id="error-password"></span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <x-btnLoading id="btnUpdateLoading" />
                        <x-btnSubmit id="btnSubmitLoading"
                            onclick="loading(true, 'btnSubmitLoading', 'btnUpdateLoading', true)" />
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal filter-->
        <div class="modal fade" id="filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Filter status</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select name="filter_status" id="filterStatus" class="form-select">
                            <option value="">--pilih status--</option>
                            <option value="active">Aktif</option>
                            <option value="suspend">Suspend</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-loadingPopup id="loadingOverlay" />
@endsection
@push('js')
    <script>
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

        $(document).ready(function() {
            getData();
            getRouter();
        });

        function getData() {
            dataTable = $('#dataTable').DataTable({
                // processing: true,
                serverSide: true,
                responsive: true,
                scrollX: true,
                autoWidth: false,
                responsive: false, // false agar scrollX aktif
                ajax: {
                    url: "{{ url()->current() }}",
                    data: function(d) {
                        d.status = $('#filterStatus').val();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        if (xhr.status === 401) {
                            swal({
                                title: "Sesi habis",
                                text: xhr.responseJSON.message,
                                icon: 'error',
                                timer: 3000,
                            }).then(() => {
                                window.location.href = '/';
                            });
                        }
                    }
                },
                columns: [{
                        data: null,
                        name: 'No',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'password',
                        name: 'password'
                    },
                    {
                        data: 'profile',
                        name: 'profile'
                    },
                    {
                        data: 'router',
                        name: 'router'
                    },
                    {
                        data: 'ip',
                        name: 'ip'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            let badgeClass = 'bg-danger';

                            if (data.toLowerCase() === 'active') {
                                badgeClass = 'bg-success';
                            } else if (data.toLowerCase() === 'suspend') {
                                badgeClass = 'bg-warning';
                            }
                            return `<span class="badge ${badgeClass} rounded-pill cursor-pointer" onclick='setStatus(${JSON.stringify([row.id, row.status])})'>${data}</span>`;
                        }
                    },
                    {
                        data: 'internet',
                        name: 'internet',
                        render: function(data, type, row) {
                            let badgeClass = 'bg-danger';

                            if (data.toLowerCase() === 'online') {
                                badgeClass = 'bg-success';
                            } else if (data.toLowerCase() === 'suspend') {
                                badgeClass = 'bg-warning';
                            }
                            return `
                            <span class="badge ${badgeClass} rounded-pill cursor-pointer">${row.internet}</span>
                        `;
                        }
                    },

                    {
                        data: null,
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                            <span class="btn btn-warning btn-sm" onclick="editData('${row.id}', '${row.username}', '${row.password}')"><i class='bx bx-edit'></i></span>
                            <span class="btn btn-danger btn-sm" onclick="hapus('/wms/config/pppoe/delete/${row.id}')"><i class='bx bx-trash'></i></span>
                        `;
                        }
                    }

                ],
                order: [
                    [0, 'asc']
                ],
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                language: langOptions,
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
        }

        async function setStatus([id, status]) {
            const willDelete = await swal({
                title: "Perbaharui status",
                text: 'Apakah Anda yakin ingin memperbaharui status PPPOE?',
                icon: "info",
                buttons: true,
                // dangerMode: true,
            });
            if (willDelete) {
                let param = {
                    url: `/wms/config/pppoe/update_status/${id}?status=${status}`,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                }

                $("#loadingOverlay").removeClass('d-none');
                await transAjax(param).then((response) => {
                    $("#loadingOverlay").addClass('d-none');
                    dataTable.ajax.reload();
                    swal({
                        title: "Berhasil",
                        text: response.message,
                        icon: 'success',
                    });
                }).catch((error) => {
                    $("#loadingOverlay").addClass('d-none');
                    console.log(error);
                });
            }
        }

        async function getRouter() {
            let param = {
                'url': '{{ url()->current() }}',
                'method': 'GET',
                'data': {
                    'data': 'router'
                }
            }

            await transAjax(param).then((result) => {
                let html = `<option value="">--Silakan Pilih--</option>`;
                let data = result.metadata;
                data.forEach(value => {
                    html += `<option value="${value.id}">${value.name}</option>`
                });
                $(".router").html(html);
            }).catch((err) => {
                console.log(err);
            });
            getProfilePPP()
        }

        async function getProfilePPP() {
            let param = {
                'url': '{{ url()->current() }}',
                'method': 'GET',
                'data': {
                    'data': 'profile_ppp'
                }
            }

            await transAjax(param).then((result) => {
                let html = `<option value="">--Silakan Pilih--</option>`;
                let data = result.metadata;
                data.forEach(value => {
                    html += `<option value="${value.id}">${value.name} | ${value.price}</option>`
                });
                $(".profile").html(html);
            }).catch((err) => {
                console.log(err);
            });
        }

        async function editData(id, username, password) {
            $("#formUpdate").attr('action', `/wms/config/pppoe/update/${id}`);
            $('#editPppoe').modal('show');
            $("#username").val(username);
            $("#password").val(password);
        }

        setInterval(() => {
            dataTable.ajax.reload(null, false);
        }, 60000);
    </script>
@endpush
