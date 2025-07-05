@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header" id="textHeader">Tambah profil ppp</h5>
                <div class="card-body">
                    <form id="formAction" action="{{ route('wms.profile_ppp.store') }}" method="POST">
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
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Grup</th>
                                <th scope="col">Harga</th>
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