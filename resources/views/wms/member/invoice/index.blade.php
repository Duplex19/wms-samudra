@extends('layouts.app')
@push('css')

<style>
        .gradient-card {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 50%, #60a5fa 100%);
            border: none;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .gradient-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 1;
        }
        
        .gradient-card::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            z-index: 1;
        }
        
        .card-content {
            position: relative;
            z-index: 2;
        }
        
        .icon-container {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .icon-container i {
            font-size: 24px;
            color: white;
        }
        
        .card-number {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0;
            line-height: 1;
        }
        
        .card-label {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .filter-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }

        /* Belum dibuka */
        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
            content: "\f0fe" !important; /* fa-plus-square */
            font-family: "Font Awesome 6 Free"; /* sesuaikan dengan versimu */
            font-weight: 900;
        }

        /* Sudah dibuka */
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td.dtr-control:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th.dtr-control:before {
            content: "\f146" !important;  /* fa-minus-square */
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
        }

        .dtr-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px !important;
            margin: 10px 0;
            width: 100% !important;
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endpush
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-food-menu"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white" id="total_invoices">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </h2>
                        <p class="card-label">{{ __('cms.total_billing') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-user-check"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white" id="paid_invoices">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </h2>
                        <p class="card-label">{{ __('cms.paid') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-user-x"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white" id="unpaid_invoices">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </h2>
                        <p class="card-label">{{ __('cms.unpaid') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-alarm"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white" id="overdue_invoices">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </h2>
                        <p class="card-label">{{ __('cms.due_date') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createInvoice">{{ __('cms.create_manual_bill') }}</button>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
                <table class="table table-sm text-nowrap" id="invoice-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ref ID</th>
                            <th>{{ __('cms.name') }}</th>
                            <th>Item</th>
                            <th>{{ __('cms.amount') }}</th>
                            <th>{{ __('cms.discount') }}</th>
                            <th>Status</th>
                            <th>Periode</th>
                            <th>{{ __('cms.address') }}</th>
                            <th>{{ __('cms.whatsapp_number') }}</th>
                            <th>{{ __('cms.due_date') }}</th>
                            <th>{{ __('cms.payment_date') }}</th>
                            <th>{{ __('cms.payment_method') }}</th>
                            {{-- <th>{{ __('cms.action') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <x-loadingTable /> --}}
                    </tbody>
                </table>
            </div>
    </div>
    <div class="modal fade" id="createInvoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Buat tagihan manual</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCreateInvoice" action="{{ route('wms.member.invoice.create') }}" method="POST" data-table="true">
                    @csrf
                    <div class="modal-body">
                        <label for="">PPPoE</label>
                        <select name="pppoe_id" id="listPppoe" class="form-select mb-3 select2">
                            {{-- render data here --}}
                        </select>
                        <span class="text-read" id="error-pppoe_id"></span>
                        <div class="form-group my-3">
                            <label for="">Periode</label>
                            <input type="month" name="periode" class="form-control">
                            <span class="text-danger" id="error-periode"></span>
                        </div>
                        <x-btnLoading id="btnLoading" />
                        <x-btnSubmit id="btnSubmit" text="Buat tagihan"  onclick="loading(true, 'btnSubmit','btnLoading')" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit jumlah pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formUpdateAmmount" action="" method="POST" data-table="true">
                    @csrf
                    <div class="modal-body">
                         <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" class="form-control" name="amount" id="priceInput">
                        </div>
                        <span class="text-read" id="error-payment_method"></span>
                        <x-btnLoading id="btnLoadingAmmount" />
                        <x-btnSubmit id="btnSubmitAmmount" text="Perbaharui"  onclick="loading(true, 'btnSubmitAmmount','btnLoadingAmmount')" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    let currentLang = localStorage.getItem("locale") || "id";

    let langOptions = {};

    if (currentLang === "id") {
        langOptions = {
            processing: "Sedang memproses...",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            loadingRecords: "Memuat data...",
            zeroRecords: "Tidak ada data yang ditemukan",
            emptyTable: "Tidak ada data yang tersedia",
            paginate: {
                first: "Pertama",
                previous: "Sebelumnya",
                next: "Selanjutnya",
                last: "Terakhir"
            }
        };
    } 
    $(document).ready(function() {
        getInvSummary();

        $('.select2').select2({
            theme: 'bootstrap4',
            dropdownParent: $('#createInvoice')
        });
    });

    async function getInvSummary()
    {
        let param = {
            url: "{{ url()->current() }}",
            method: "GET",
            data: {
                'category': 'inv_summary'
            }
        };

        await transAjax(param).then((result) => {
            $("#total_invoices").html(result.metadata.total_invoices);
            $("#unpaid_invoices").html(result.metadata.unpaid_invoices);
            $("#paid_invoices").html(result.metadata.paid_invoices);
            $("#overdue_invoices").html(result.metadata.overdue_invoices);
        }).catch((err) => {
            return alert('Gagal mengambil data summary');
        });

        getDataTable();
    }

    function  getDataTable()
    {
        dataTable = $('#invoice-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url()->current() }}',
            data: function(d) {
                d.status = $('#status-filter').val();
                d.payment_method = $('#payment-method-filter').val();
                d.date_from = $('#date-from').val();
                d.date_to = $('#date-to').val();
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
            { data: 'ref_id', name: 'ref_id' },
            { data: 'name', name: 'name' },
            { data: 'item', name: 'item' },
            { data: 'amount', name: 'amount' },
            { data: 'discount', name: 'discount' },
            { data: 'status', name: 'status', render: function(data, type, row) {
                let badgeClass = 'bg-secondary'; 

                if (data.toLowerCase() === 'paid') {
                    badgeClass = 'bg-success';
                } else if (data.toLowerCase() === 'unpaid') {
                    badgeClass = 'bg-warning';
                }
                return `<span class="badge ${badgeClass} rounded-pill cursor-pointer" onclick='setStatus(${JSON.stringify([row.id, row.status])})'>${data == 'paid' ? 'Dibayar' : 'Belm dibayar'}</span>`;
            }},
            { data: 'periode', name: 'periode' },
            { data: 'address', name: 'address' },
            { data: 'whatsapp', name: 'whatsapp', orderable: false },
            { data: 'due_date', name: 'due_date' },
            { data: 'paid_date', name: 'paid_date' },
            { data: 'payment_method', name: 'payment_method' },
        ],
        order: [[1, 'desc']], // Order by ref_id desc
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        language: langOptions,
        responsive: true,
        autoWidth: false,
        });

        getPPPoE();
    }

    async function getPPPoE()
    {
        let param = {
            url: "{{ url()->current() }}",
            method: "GET",
            data: {
                "category": "list_pppoe"
            }
        }

        await transAjax(param).then((result) => {
            let html = '';
            result.metadata.forEach(item => {
                html += `<option value="${item.id}">${item.name} | ${item.username} | ${item.whatsapp}</option>`
            });
            $("#listPppoe").html(html);
        }).catch((err) => {
            alert('Gagal mengambil data lisr pppoe');
        })
    }


    // Filter button event
    $('#filter-btn').on('click', function() {
        table.ajax.reload();
    });

    // Reset button event
    $('#reset-btn').on('click', function() {
        $('#status-filter').val('all');
        $('#payment-method-filter').val('all');
        $('#date-from').val('');
        $('#date-to').val('');
        table.ajax.reload();
    });

    // Export button event
    $('#export-btn').on('click', function() {
        var params = new URLSearchParams({
            status: $('#status-filter').val(),
            payment_method: $('#payment-method-filter').val(),
            date_from: $('#date-from').val(),
            date_to: $('#date-to').val()
        });
        
        window.location.href = '#' + params.toString();
    });

    // View detail button event
    $(document).on('click', '.view-btn', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '#'.replace(':id', id),
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    var data = response.data;
                    
                    $('#detail-ref-id').text(data.ref_id);
                    $('#detail-name').text(data.name);
                    $('#detail-address').text(data.address);
                    $('#detail-whatsapp').html('<a href="https://wa.me/' + data.whatsapp + '" target="_blank">' + data.whatsapp + '</a>');
                    $('#detail-item').text(data.item);
                    $('#detail-periode').text(data.periode);
                    $('#detail-amount').text(data.amount);
                    $('#detail-discount').text(data.discount);
                    $('#detail-due-date').text(data.due_date);
                    $('#detail-paid-date').text(data.paid_date || 'Belum dibayar');
                    $('#detail-payment-method').text(data.payment_method || 'Belum ada');
                    
                    var statusBadge = data.status === 'paid' ? 
                        '<span class="badge badge-success">Paid</span>' : 
                        '<span class="badge badge-danger">Unpaid</span>';
                    $('#detail-status').html(statusBadge);
                    
                    $('#detailModal').modal('show');
                }
            },
            error: function() {
                alert('Error loading invoice details');
            }
        });
    });

    async function setStatus([id, status])
     {
        const willUpdate = await swal({
            title: "Perbaharui status",
            text: 'Apakah Anda yakin ingin memperbaharui status pembayaran ini?',
            icon: "info",
            buttons: true,
            // dangerMode: true,
        });
        if (willUpdate) {
            let param = {
                url: `/wms/config/pppoe/update_status/${id}?status=${status}`,
                method: "POST",
                processData: false,
                contentType: false,
                cache: false,
            }

            $("#loadingOverlay").removeClass('d-none');
            await transAjax(param).then((response) => {
                $("#loadingOverlay").addClass('d-none');
                dataTable.ajax.reload();
                swal({
                    title: "Berhasil",
                    text: response.message,
                    icon: 'success',
                });
            }).catch((error) => {
                $("#loadingOverlay").addClass('d-none');
                if(error.status === 401) {
                    swal({ 
                        title: 'Sesi habis',
                        text:  error.responseJSON.message, 
                        icon: 'error', 
                        timer: 3000,
                    }).then(() => {
                        window.location.href = '/';
                    });
                }else {
                    swal({ 
                        title: 'Gagal',
                        text:  error.responseJSON.message, 
                        icon: 'error', 
                    });
                }    
            });
        }
    }

    async function sendReminder(id)
    {
        const willUpdate = await swal({
            title: "Kirim pengingat",
            text: 'Kirim pesan pengingat pembayaran melalui WhatsApp?',
            icon: "info",
            buttons: true,
            // dangerMode: true,
        });
        if (willUpdate) {
            let param = {
                url: `/wms/member/invoice/send_reminder/${id}`,
                method: "POST",
                processData: false,
                contentType: false,
                cache: false,
            }

            $("#loadingOverlay").removeClass('d-none');
            await transAjax(param).then((response) => {
                $("#loadingOverlay").addClass('d-none');
                swal({
                    title: "Berhasil",
                    text: response.message,
                    icon: 'success',
                });
            }).catch((error) => {
                $("#loadingOverlay").addClass('d-none');
                if(error.status === 401) {
                    swal({ 
                        title: 'Sesi habis',
                        text:  error.responseJSON.message, 
                        icon: 'error', 
                        timer: 3000,
                    }).then(() => {
                        window.location.href = '/';
                    });
                }else {
                    swal({ 
                        title: 'Gagal',
                        text:  error.responseJSON.message, 
                        icon: 'error', 
                    });
                } 
            });
        }
    }

    function copyLink(link) {
        navigator.clipboard.writeText(link)
        .then(() => {
            swal({
                title: "Berhasil",
                text: "Link pembayaran berhasil disalin",
                icon: 'success',
            });
        })
        .catch((err) => {
            console.error('Gagal menyalin link:', err);
            swal({
                title: "Gagal",
                text: "Link tidak dapat disalin ke clipboard",
                icon: 'error',
            });
        });
    }

    function payment(id)
    {
        $("#payment").modal('show');
        $("#formPayment").attr('action', `/wms/member/invoice/payment/${id}`)
    }

    function editData(id, amount)
    {
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
        
        $("input[name=amount]").val(amount.replace(/Rp\s?/i, '').trim());
        $("#editData").modal('show');
        $("#formUpdateAmmount").attr('action', `/wms/member/invoice/update/${id}`)
    }
    </script>
@endpush