@extends('layouts.app')
@section('content')
<a href="{{ route('wms.sechedule') }}" class="btn {{ Request::is('wms/config/setting/sechedule') ? 'btn-primary' : ' btn-outline-primary' }}  mb-3">Jadwal konfigurasi</a>
<a href="{{ route('wms.billing') }}" class="btn btn-outline-primary mb-3">Pengaturan penagihan</a>
<a href="{{ route('wms.registration') }}" class="btn {{ Request::is('wms/config/setting/registration') ? 'btn-primary' : ' btn-outline-primary' }} mb-3">Pengaturan pendaftaran</a>
<div class="card">
    <h5 class="card-header">Pengaturan pendaftaran</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <label for="">Status pendaftaran</label>
                <form action="{{ route('wms.registration.update') }}" method="POST" data-table="false">
                    @csrf
                    <div class="input-group">
                        <select name="status" id="registrationStatus" class="form-select">
                            
                        </select>
                        <x-btnLoading id="btnLoading" />
                        <x-btnSubmit id="btnSubmit" text="Perbaharui" onclick="loading(true, 'btnSubmit','btnLoading')" />
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <label for="">Biaya pendaftaran</label>
                <form action="{{ route('wms.registration.price') }}" method="POST" data-table="false">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                        <input type="text" class="form-control" name="price" id="registrationPrice" value="">
                        <x-btnLoading id="btnLoadingPrice" />
                        <x-btnSubmit id="btnSubmitPrice" text="Perbaharui" onclick="loading(true, 'btnSubmitPrice','btnLoadingPrice')" />
                    </div>
                </form>
            </div>
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

        async function getData() {
            let param = {
                'url': '{{ url()->current() }}',
                'method': 'GET',
            }

            await transAjax(param).then((result) => {
                let data = result.metadata;

                let status = data.registrationStatus.status;

                let html = `
                    <option value="open" ${status === 'open' ? 'selected' : ''}>Dibuka</option>
                    <option value="close" ${status === 'close' ? 'selected' : ''}>Ditutup</option>
                `;

                $("#registrationStatus").html(html);

               $("#registrationPrice").val(data.registrationPrice.price.toLocaleString('id-ID'));
            }).catch((err) => {
                console.log(err);
            });
        }

        document.getElementById('registrationPrice').addEventListener('input', function (e) {
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
    </script>
@endpush