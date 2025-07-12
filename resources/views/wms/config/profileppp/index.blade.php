@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header" id="textHeader">Tambah profil ppp</h5>
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        <h4 class="alert-heading">Informasi</h4>
                        <p>Pastikan Group sama dengan nama Profile di router</p>
                    </div>
                    <form id="formAction" action="{{ route('wms.profile_ppp.store') }}" method="POST" data-table="true">
                        @csrf
                        <div class="form-group mb-3">
                        <label for="">Nama*</label>
                        <input type="text" class="form-control" name="name">
                        <span class="text-danger" id="error-name"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Grup*</label>
                            <input type="text" class="form-control" name="group">
                             <span class="text-danger" id="error-group"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Harga*</label>
                            <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" class="form-control" name="price" id="priceInput">
                            </div>
                            <span class="text-danger" id="error-price"></span>
                        </div>
                        <x-btnLoading id="btnLoading" />
                        <x-btnSubmit id="btnSubmit" onclick="loading(true, 'btnSubmit', 'btnLoading', true)" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">List data profil ppp</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="dataTable" class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Grup</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody >
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
                    {data: 'group', name: 'group'},
                    {data: 'price', name: 'price'}, 
                    {
                        data: null,
                        name: 'aksi',
                        render: function(data,type,row) {
                            return `
                            <span class="btn btn-warning btn-sm" id="edit" onclick='edit(${JSON.stringify(row)})'><i class='bx  bx-edit'></i></span>
                            <span class="btn btn-danger btn-sm" onclick="hapus('/wms/config/profile_ppp/delete/${row.id}')"><i class='bx  bx-trash'></i></span>
                            `
                        }
                    }, 
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


        document.getElementById('priceInput').addEventListener('input', function (e) {
        let value = this.value.replace(/[^\d]/g, '');
        if (!value) {
            this.value = '';
            return;
        }

        this.value = formatRupiah(value);
        });

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
        
        function edit(data)
        {
            let {id, name, group, price} = data;
            
            $("#formAction").attr('action','/wms/config/profile_ppp/update/' + id);
            $("#textHeader").text('Update profil pppp');

            $("input[name=name]").val(name);
            $("input[name=group]").val(group);
            $("input[name=price]").val(price.replace(/Rp\s?/i, '').trim());
             
            $("#btnSubmit").text('Upadate');
        }
    </script>
@endpush