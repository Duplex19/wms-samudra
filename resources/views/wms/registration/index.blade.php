@extends('layouts.app')
@push('css')
    <style>
        .dtr-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px !important;
            margin: 10px 0;
            width: 100% !important;
        }

        .form-body {
            max-height: 50vh;
            overflow-y: auto;
        }
    </style>
@endpush
@section('content')
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addVpnServer"><i
            class="menu-icon icon-base bx bx-user-plus"></i>
        Formulir pendaftaran</button>
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">List data registrasi pelanggan</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="dataTable" class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No WhatsApp</th>
                                <th scope="col">Tgl pendaftaran</th>
                                <th scope="col">Tgl Update</th>
                                <th scope="col">Diproses oleh</th>
                                <th scope="col">Status Pemasangan</th>
                                <th scope="col">Status Pembayaran</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">NPWP</th>
                                <th scope="col">Foto NPWP</th>
                                <th scope="col">External link</th>
                                <th scope="col">Link pembayaran</th>
                                <th scope="col">Foto Lokasi</th>
                                <th scope="col">Foto Selfi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <x-loadingTable colspan="8" />
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal add PPPOE -->
        <div class="modal fade" id="addVpnServer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrasi pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body form-body">
                        <div class="row">
                            <form action="{{ route('wms.registration.store') }}" method="POST" data-table="true"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="">Kategori</label>
                                    <select name="category" id="category" class="form-select">
                                        <option value="retail">Retail</option>
                                        <option value="corporate">Corprate</option>
                                    </select>
                                    <span class="text-danger" id="error-category"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Profil PPPoE</label>
                                    <select name="profile_ppp_id" id="profile_ppp_id" class="form-select">

                                    </select>
                                    <span class="text-danger" id="error-profile_ppp_id"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Nama lengkap</label>
                                    <input type="text" class="form-control" name="nama_lengkap">
                                    <span class="text-danger" id="error-nama_lengkap"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                                    <span class="text-danger" id="error-alamat"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Nomor whatsapp</label>
                                    <input type="text" class="form-control" name="no_whatsapp">
                                    <span class="text-danger" id="error-no_whatsapp"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">NIK</label>
                                    <input type="text" class="form-control" name="nik">
                                    <span class="text-danger" id="error-nik"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">NPWP</label>
                                    <input type="text" class="form-control" name="npwp">
                                    <span class="text-danger" id="error-npwp"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Foto NPWP</label>
                                    <input type="file" class="form-control" name="foto_npwp">
                                    <span class="text-danger" id="error-foto_npwp"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Foto Selfi</label>
                                    <input type="file" class="form-control" name="foto_selvie">
                                    <span class="text-danger" id="error-foto_selvie"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Foto KTP</label>
                                    <input type="file" class="form-control" name="foto_ktp">
                                    <span class="text-danger" id="error-foto_ktp"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Foto lokasi</label>
                                    <input type="file" class="form-control" name="foto_lokasi">
                                    <span class="text-danger" id="error-foto_lokasi"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Latitude</label>
                                    <input type="text" class="form-control" name="latitude">
                                    <span class="text-danger" id="error-latitude"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Longitude</label>
                                    <input type="text" class="form-control" name="longitude">
                                    <span class="text-danger" id="error-longitude"></span>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" name="disclaimer" type="checkbox" value="1"
                                        id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Disclaimer
                                    </label>
                                </div>
                                <x-btnLoading id="btnLoading" />
                                <x-btnSubmit id="btnSubmit" onclick="loading(true, 'btnSubmit', 'btnLoading', true)" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="locationModalTitle">Alamat dan lokasi pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="address"></p>
                        <hr>
                        <div style="width:100%; height:400px;" id="location"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="photoModalTitle"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <picture id="photoRegistrasi">
                            <h5 class="card-title placeholder-glow">
                                <span class="placeholder col-6"></span>
                            </h5>
                            <p class="card-text placeholder-glow">
                                <span class="placeholder col-7"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-6"></span>
                                <span class="placeholder col-8"></span>
                            </p>
                        </picture>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            getProfilePppoe();
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
                columns: [{
                        data: null,
                        name: 'No',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: null,
                        name: 'alamat',
                        render: function(row) {
                            return `<span class="badge bg-info rounded-pill cursor-pointer" onclick="getLocation('${row.alamat}', '${row.location}')">lihat di google maps</span>`
                        }
                    },
                    {
                        data: 'no_whatsapp',
                        name: 'no_whatsapp',
                        render: function(data) {
                            let nomor = data.replace(/[^0-9]/g, '');
                            return `<a href="https://wa.me/${nomor}" target="_blank" class="badge bg-success rounded-pill cursor-pointer">${data}</a>`;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                    },
                    {
                        data: 'latestStatus',
                        name: 'latestStatus',
                        render: function(data) {
                            if (!data.user) return '<span class="badge bg-danger rounded-pill">belum diproses</span>';
                            return `<span class="badge bg-primary rounded-pill cursor-pointer">
                                        ${data.user}
                                    </span>`;

                        }
                    },
                    {
                        data: 'latestStatus',
                        name: 'latestStatus',
                        render: function(data) {
                            if (!data) return '-';

                            let badgeClass = 'bg-danger';
                            if (data.status.toLowerCase() === 'done') {
                                badgeClass = 'bg-primary';
                            } else if (data.status.toLowerCase() === 'approve') {
                                badgeClass = 'bg-success';
                            } else if (data.status.toLowerCase() === 'waiting') {
                                badgeClass = 'bg-warning';
                            }

                            return `<span class="badge ${badgeClass} rounded-pill cursor-pointer">
                                        ${data.status.toLowerCase()}
                                    </span>`;
                        }
                    },
                    {
                        data: 'status_pay',
                        name: 'status_pay',
                        render: function(data) {
                            let badgeClass = 'bg-danger';
                            if (data.toLowerCase() === 'paid' || data.toLowerCase() === 'settled') {
                                badgeClass = 'bg-primary';
                            } else if (data.toLowerCase() === 'approve') {
                                badgeClass = 'bg-success';
                            } else if (data.toLowerCase() === 'waiting' || data.toLowerCase() ===
                                'pending') {
                                badgeClass = 'bg-warning';
                            }
                            return `
                                <span class="badge ${badgeClass} rounded-pill cursor-pointer">${data.toLowerCase()}</span>
                            `;
                            return data.status;
                        }
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                    },
                    {
                        data: 'category',
                        name: 'category',
                    },
                    {
                        data: 'npwp',
                        name: 'npwp',
                        render: function(data) {
                            if(!data) return '-';
                            return data;
                        }
                    },
                    {
                        data: 'foto_npwp',
                        name: 'foto_npwp',
                        render: function(data) {
                            return `<span class="badge bg-info rounded-pill cursor-pointer" onclick="showPhoto('${data}','Foto lokasi')">lihat foto</span>`
                        }
                    },
                    {
                        data: 'external_id',
                        name: 'external_id',
                        render: function(data) {
                            if(!data) return '-';
                            return data;
                        }
                    },
                    {
                        data: 'checkout_link',
                        name: 'checkout_link',
                        render: function(data) {
                            if(!data) return '-';
                            return data;
                        }
                    },
                    {
                        data: 'foto_lokasi',
                        name: 'foto_lokasi',
                        render: function(data) {
                            return `<span class="badge bg-info rounded-pill cursor-pointer" onclick="showPhoto('${data}','Foto lokasi')">lihat foto</span>`
                        }
                    },
                    {
                        data: 'foto_selvie',
                        name: 'foto_selvie',
                        render: function(data) {
                            return `<span class="badge bg-info rounded-pill cursor-pointer" onclick="showPhoto('${data}','Foto selfi')">lihat foto</span>`
                        }
                    },
                ],
                order: [
                    [0, 'asc']
                ],
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
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

        async function getProfilePppoe() {
            let param = {
                url: "/wms/config/profile_ppp",
                method: "GET"
            }

            await transAjax(param).then((result) => {
                const dataArray = result.data;
                let html = "";
                dataArray.forEach(element => {
                    html += `
                        <option value="${element.id}">${element.name} | ${element.price}</option>
                    `
                });
                $("#profile_ppp_id").html(html);
            }).catch((err) => {
                console.log(err);
            });
        }

        function getLocation(address, location) {
            $("#locationModal").modal("show");
            $("#address").html(`<span class="fw-bold">Alamat</span>: ${address}`);
            $("#location").html(
                `
                <iframe
                    src="${location}&hl=es;z=14&output=embed"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen
                    loading="lazy">
                </iframe>
                `
            )
        }

        function showPhoto(url, title) {
            $("#photoModalTitle").html(title);
            $("#photoModal").modal("show");
            $("#photoRegistrasi").html(`<img src="${url}" alt="photo">`)
        }
    </script>
@endpush
