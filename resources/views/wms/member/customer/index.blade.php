@extends('layouts.app')
@push('css')
    <style>
        .dtr-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px !important;
            margin: 10px 0;
            width: 100% !important;
        }
    </style>
@endpush
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">List data anggota</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="dataTable" class="table table-sm">
                    <thead class="table-light">
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nama pengguna</th>
                        <th scope="col">WhatsApp</th>
                        <th scope="col">Tgl Aktif</th>
                        <th scope="col">Tipe Pembayaran</th>
                        <th scope="col">Status</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Router</th>
                        <th scope="col">Profil</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <x-loadingTable colspan="12"/>
                    </tbody>
            </table>
        </div>
    </div>

        <div class="modal fade" id="editPppoe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data anggota</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="formUpdate" action="#" data-table="true" method="POST" data-table="true">
                        @method('PUT')
                        @csrf
                        <div class="row g-3">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Nama*</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    <span class="text-danger" id="error-name"></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">WhatsApp*</label>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp">
                                    <span class="text-danger" id="error-whatsapp"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Tanggal aktif*</label>
                                    <input type="date" class="form-control" id="active_date" name="active_date">
                                    <span class="text-danger" id="error-active_date"></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Alamat*</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                    <span class="text-danger" id="error-address"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Tipe pembayaran*</label>
                                    <select name="payment_type" id="payment_type" class="form-select">
                                        <option value="postpaid">Postpaid</option>
                                        <option value="prepaid">Prepaid</option>
                                    </select>
                                    <span class="text-danger" id="error-payment_type"></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Diskon*</label>
                                    <input type="text" class="form-control" id="discount" name="discount">
                                    <span class="text-danger" id="error-discount"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="note">Catatan</label>
                            <textarea type="text" class="form-control" name="note"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <x-btnLoading id="btnUpdateLoading" />
                    <x-btnSubmit id="btnSubmitLoading" onclick="loading(true, 'btnSubmitLoading', 'btnUpdateLoading', true)" />
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
                serverSide: true,
                responsive: true,
                // scrollX: true,
                // autoWidth: false,
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
                    {data: 'username', name: 'username'},
                    {data: 'whatsapp', name: 'whatsapp', render: function(data) {
                        let nomor = data.replace(/[^0-9]/g, '');
                        return `<a href="https://wa.me/${nomor}" target="_blank" class="badge bg-success rounded-pill cursor-pointer">${data}</a>`;
                    }},
                    {
                    data: 'active_date',
                    name: 'active_date',
                    render: function(data) {
                        return new Date(data).toLocaleDateString('id-ID', {
                        day: 'numeric', month: 'long', year: 'numeric'
                        });
                    }
                    },
                    {data: 'payment_type', name: 'payment_type'},
                    {
                        data: 'status',
                        name: 'status',
                        render: function (data, type, row) {
                            let badgeClass = 'bg-danger'; 

                            if (data.toLowerCase() === 'active') {
                                badgeClass = 'bg-success';
                            } else if (data.toLowerCase() === 'suspend') {
                                badgeClass = 'bg-warning';
                            }
                            return `<span class="badge ${badgeClass} rounded-pill cursor-pointer" onclick='setStatus(${JSON.stringify([row.id, row.status])})'>${data}</span>`;
                        }
                    },
                    {data: 'amount', name: 'amount'},
                    {data: 'discount', name: 'discount'},
                    {data: 'router', name: 'router'},
                    {data: 'profile', name: 'profile'},
                    {data: 'note', name: 'note', render: function(data,type,row) {
                        if(row.note == null) {
                            return 'Tdk ada catatan'
                        }else {
                            return row.note;
                        };
                    }},
                    {
                        data: null,
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <span class="btn btn-warning btn-sm" onclick='editData(${JSON.stringify(row)})'><i class='bx bx-edit'></i></span>
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

        function editData(data)
        {
            let {id, name,whatsapp,active_date,address,payment_type,discount,note} = data;
            $("#formUpdate").attr('action', `/wms/member/customer/${id}`);
            $("#name").val(name);
            $("#whatsapp").val(whatsapp);
            $("#active_date").val(active_date);
            $("#address").val(address);
            $("#payment_type").val(payment_type);
            $("#discount").val(discount);
            $("#note").val(note);
            $('#editPppoe').modal('show');
        }

    </script>
@endpush