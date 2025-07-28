@extends('layouts.app')
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
                                <span class="btn btn-warning btn-sm" onclick="editData('${row.id}', '${row.username}', '${row.password}')"><i class='bx bx-edit'></i></span>
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