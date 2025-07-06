@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h5 class="card-header" id="textHeader">Tambah pppoe</h5>
        <div class="card-body">
            <div class="row">
                 <form id="formAction" action="{{ route('wms.pppoe.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="">Router*</label>
                            <select name="router_id" id="router_id" class="form-select">
                                <option>--pilih router--</option>
                            </select>
                            <span class="text-danger" id="error-router_id"></span>
                        </div>
                    </div>
                    <div class="col">
                         <div class="form-group mb-3">
                            <label for="">Profil PPP*</label>
                            <select name="profile_ppp_id" id="profile_ppp_id" class="form-select">
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
                                <option>--pilih status--</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tdk aktif</option>
                            </select>
                            <span class="text-danger" id="error-status"></span>
                        </div>
                    </div>
                </div>
            </div>
            <x-btnLoading id="btnLoading" />
            <x-btnSubmit id="btnSubmit" onclick="loading(true, 'btnSubmit', 'btnLoading', true)" />
            </form>
        </div>
    </div>
</div>
<div class="col-md-12 mt-3">
        <div class="card">
            <h5 class="card-header">List data pppe</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-sm">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Nama pengguna</th>
                                <th scope="col">Password</th>
                                <th scope="col">Profil</th>
                                <th scope="col">Router</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dataTable">
                            <x-loadingTable colspan="12" />
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
            getRouter();
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
                let html = "";
                let data = result.metadata;
                data.forEach(value => {
                    html += `<option value="${value.id}">${value.name}</option>`
                });
                $("#router_id").html(html);
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
                let html = "";
                let data = result.metadata;
                data.forEach(value => {
                    html += `<option value="${value.id}">${value.name}</option>`
                });
                $("#profile_ppp_id").html(html);
            }).catch((err) => {
                console.log(err);
            });
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