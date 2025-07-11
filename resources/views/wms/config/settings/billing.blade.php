@extends('layouts.app')
@section('content')
<a href="{{ route('wms.sechedule') }}" class="btn {{ Request::is('wms/config/setting/sechedule') ? 'btn-primary' : ' btn-outline-primary' }}  mb-3">Jadwal konfigurasi</a>
<a href="{{ route('wms.billing') }}" class="btn {{ Request::is('wms/config/setting/billing') ? 'btn-primary' : ' btn-outline-primary' }} mb-3">Pengaturan penagihan</a>
<div class="card">
    <h5 class="card-header">Pengaturan Penagihan</h5>
    <div class="card-body">
        <form id="formUpdate" action="" method="POST" data-table="false" data-resetForm="false">
            @method('PUT')
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="">Tanggal Pembuatan Invoice</label>
                    <input type="number" name="date_invoice" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Tanggal Pengingat</label>
                    <input type="number" name="date_reminder" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Tanggal Jatuh Tempo</label>
                    <input type="number" name="due_date" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Tanggal Penangguhan</label>
                    <input type="number" name="date_suspend" class="form-control">
                </div>
            </div>
            <x-btnLoading id="btnLoading" />
            <x-btnSubmit text="Perbaharui" id="btnSubmit" onclick="loading(true, 'btnSubmit', 'btnLoading')" />
        </form>
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
                let data = result.metadata[0];
                $("#formUpdate").attr('action', `/wms/config/pengaturan_penagihan/update/${data.id}`);
                $("input[name=date_invoice]").val(data.date_invoice);
                $("input[name=date_reminder]").val(data.date_reminder);
                $("input[name=due_date]").val(data.due_date);
                $("input[name=date_suspend]").val(data.date_suspend);
            
            }).catch((err) => {
                console.log(err);
            });
        }
    </script>
@endpush