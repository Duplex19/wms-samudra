@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header" id="textHeader">Tambah router</h5>
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">Informasi</h4>
                    <p>Untuk kolom IP, gunakan IP public atau IP client dari <a href="{{ route('wms.vpn') }}">VPN Server <i class="bx bx-link-external"></i></a></p>
                    </div>
                    <form id="formAction" action="{{ route('wms.router.store') }}" method="POST">
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
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">IP</th>
                                <th scope="col">Port</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="dataTable">
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
            getData();
        });

        async function getData() {
            let param = {
                'url': '{{ url()->current() }}',
                'method': 'GET',
            }

            await transAjax(param).then((result) => {
                $("#dataTable").html(result);
            }).catch((err) => {
                console.log(err);
            });
        }

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
                console.log(err.responseJSON.message);
                swal({ 
                    title: 'Gagal',
                    text:  err.responseJSON.message, 
                    icon: 'error', 
                });
            });
            getData();
        }
    </script>
@endpush