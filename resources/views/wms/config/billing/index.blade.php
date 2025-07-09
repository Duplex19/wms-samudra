@extends('layouts.app')
@section('content')
    <div class="alert alert-primary" role="alert">
    <h4 class="alert-heading">Informasi</h4>
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group list-group-flush">
                <li class="list-group-item fw-semibold">Tanggal Pembuatan Invoice</li>
                <li class="list-group-item fw-semibold">Tanggal Pengingat</li>
                <li class="list-group-item fw-semibold">Tanggal Jatuh Tempo</li>
                <li class="list-group-item fw-semibold">Tanggal Penangguhan</li>
            </ul>
        </div>
        <div class="col-md-9">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Tanggal pembuatan tagihan setiap bulan</li>
                <li class="list-group-item">Tanggal pengiriman pengingat tagihan pelanggan jika belum melakukan pembayaran </li>
                <li class="list-group-item">Tanggal jatuh tempo tagihan pembayaran</li>
                <li class="list-group-item">Tanggal penangguhan ( isolir ) jika belum melakukan pembayaran</li>
            </ul>
        </div>
    </div>
    </div>
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