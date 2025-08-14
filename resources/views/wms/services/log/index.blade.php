@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header">List data aktivitas pengguna</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="dataTable" class="table table-sm">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Pengguna</th>
                        <th scope="col">Aktivitas</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Alamat IP</th>
                        <th scope="col">User Agent</th>
                        <th scope="col">Dibuat pada</th>
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
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            dataTable = $('#dataTable').DataTable({
                serverSide: true,
                responsive: true,
                scrollX: true,
                autoWidth: false,
                responsive: false,
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
                    {data: 'user', name: 'user', render: function(data, type, row,meta) {
                        if(row.user == '') {
                            return 'Tdk diketahui'
                        }else {
                            return row.user;
                        }
                    }},
                    {data: 'activity', name: 'activity'},
                    {data: 'description', name: 'description'},
                    {data: 'ip_address', name: 'ip_address'},
                    {data: 'user_agent', name: 'user_agent'},
                    {data: 'created_at', name: 'created_at', render: function(data, type, row,meta) {
                        if (!data) return '';
                            const date = new Date(data);
                            return new Intl.DateTimeFormat('id-ID', {
                            day: '2-digit', month: 'long', year: 'numeric',
                            hour: '2-digit', minute: '2-digit', second: '2-digit'
                        }).format(date);
                    }},
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