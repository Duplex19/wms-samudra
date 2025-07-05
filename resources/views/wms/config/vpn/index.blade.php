@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Tambah akun VPN Server</h5>
                <div class="card-body">
                    <form action="{{ route('wms.vpn.store') }}" method="POST">
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
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">List data VPN Server</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-sm">
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
    </script>
@endpush