@extends('layouts.app')
@section('content')
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addVpnServer"><i class="bx bx-server"></i> Tambah akun VPN Server</button>
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">List data VPN Server</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="dataTable" class="table table-sm">
                    <thead class="table-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Ip Server</th>
                        <th scope="col">Screet</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Ip Client</th>
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
<!-- Modal add PPPOE -->
    <div class="modal fade" id="addVpnServer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah akun VPN Server</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="{{ route('wms.vpn.store') }}" method="POST" data-table="true">
                        @csrf
                        <div class="form-group mb-3">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="name">
                        <span class="text-danger" id="error-name"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Nama pengguna</label>
                            <input type="text" class="form-control" name="username">
                             <span class="text-danger" id="error-username"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="password">
                            <span class="text-danger" id="error-password"></span>
                        </div>
                        <x-btnLoading id="btnLoading" />
                        <x-btnSubmit id="btnSubmit" onclick="loading(true, 'btnSubmit', 'btnLoading', true)" />
                    </form>
            </div>
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
                    {data: 'ip_server', name: 'ip_server'},
                    {data: 'secret', name: 'secret'},
                    {data: 'username', name: 'username'},
                    {data: 'password', name: 'password'},
                    {data: 'ip_client', name: 'ip_client'},
                    {   
                    data: null,
                    name: 'aksi',
                    orderable: false,
                    searchable: false,
                        render: function(data, type, row) {
                            return `
                                <span class="btn btn-danger btn-sm" onclick="hapus('/wms/config/vpn/delete/${row.id}')"><i class='bx  bx-trash'></i></span>
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
        });
    </script>
@endpush