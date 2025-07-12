@extends('layouts.app')
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
<a href="{{ route('wms.registration') }}" class="btn {{ Request::is('wms/config/setting/registration') ? 'btn-primary' : ' btn-outline-primary' }} mb-3">Pengaturan pendaftaran</a>
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
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit jadwal konfigurasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formUpdate" action="" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="time" name="time" class="form-control mb-3">
                    <x-btnLoading id="btnLoading" />
                    <x-btnSubmit id="btnSubmit" text="Perbaharui"  onclick="loading(true, 'btnSubmit','btnLoading')" />
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
<script type="text/javascript">
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
                    return `<button class="btn btn-warning btn-sm" onclick="editData('${row.id}','${row.time}')"><i class='bx  bx-edit'></i></button>`;
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

    function editData(id)
        {
            $("#formUpdate").attr('action',`/wms/config/setting/sechedule/update/${id}`);
            $("#editData").modal("show");
        }
    </script>
@endpush