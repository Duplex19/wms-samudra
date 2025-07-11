@extends('layouts.app')
@push('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
@section('content')
    {{-- <div class="alert alert-primary" role="alert">
    <h4 class="alert-heading">Informasi</h4>
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group list-group-flush">
                <li class="list-group-item fw-semibold">Tanggal Pembuatan Invoice</li>
                <li class="list-group-item fw-semibold">Tanggal Pengingat</li>
                <li class="list-group-item fw-semibold">Tanggal Jatuh Tempo</li>
                <li class="list-group-item fw-semibold">Tanggal Penangguhan</li>
            </ul>
        </div>
        <div class="col-md-9">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Tanggal pembuatan tagihan setiap bulan</li>
                <li class="list-group-item">Tanggal pengiriman pengingat tagihan pelanggan jika belum melakukan pembayaran </li>
                <li class="list-group-item">Tanggal jatuh tempo tagihan pembayaran</li>
                <li class="list-group-item">Tanggal penangguhan ( isolir ) jika belum melakukan pembayaran</li>
            </ul>
        </div>
    </div>
    </div> --}}
<a href="{{ route('wms.sechedule') }}" class="btn {{ Request::is('wms/config/setting/sechedule') ? 'btn-primary' : ' btn-outline-primary' }}  mb-3">Jadwal konfigurasi</a>
<a href="{{ route('wms.billing') }}" class="btn btn-outline-primary mb-3">Pengaturan penagihan</a>
<div class="card">
    <div class="card-body">
        <div class="table-responsive mt-2">
                <table id="dataTable" class="table table-sm text-nowrap">
                    <thead class="filter-section">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama konfigurasi</th>
                            <th scope="col">Command</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <x-loadingTable colspan="12" />
                    </tbody>
            </table>
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
    $(document).ready(function() {
        getData();
    });

    function getData()
    {
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
                {data: 'command', name: 'command'},
                {data: 'time', name: 'time'},
                {data: null, name: null, render: function(data, type, row, meta) {
                    return `<button class="btn btn-warning btn-sm"><i class='bx  bx-edit'></i></button>`;
                }},
            ],
            order: [[0, 'asc']],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            language: {
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
                first: '<i class="fas fa-angle-double-left"></i>',
                previous: '<i class="fas fa-angle-left"></i>',
                next: '<i class="fas fa-angle-right"></i>',
                last: '<i class="fas fa-angle-double-right"></i>'
                },
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
    }
    </script>
@endpush