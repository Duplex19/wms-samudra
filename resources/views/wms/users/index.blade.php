@extends('layouts.app')
@section('content')
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addVpnServer"><i
            class="menu-icon icon-base bx bx-user"></i>
        Tambah user</button>
    <div class="row mb-12 g-6" id="team">
        <div class="col-md-4">
            <div class="card" aria-hidden="true">
                <div class="card-body">
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
                    <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" aria-hidden="true">
                <div class="card-body">
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
                    <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" aria-hidden="true">
                <div class="card-body">
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
                    <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="" id="updateUser" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Manajemen tim</label>
                            <select class="form-select" name="team_management_id">
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Nama tim</label>
                            <input type="text" class="form-control" name="team">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Nomor WhatsApp</label>
                            <input type="text" class="form-control" name="whatsapp">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Foto</label>
                            <input type="file" class="form-control" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select class="form-select" name="role">
                                <option value="admin">admin</option>
                                <option value="management">management</option>
                                <option value="teknisi">teknisi</option>
                            </select>
                        </div>
                        <hr>
                        <label for="" class="fw-bold mb-2">Akun bank</label>
                        <div class="form-group mb-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" id="namaPemilikRekening">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Nama bank</label>
                            <input type="text" class="form-control" name="bank_code">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Nomor rekening</label>
                            <input type="text" class="form-control" name="norek">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-btnLoading id="btnLoading" />
                        <x-btnSubmit text="Perbaharui" id="btnSubmit"
                            onclick="loading(true, 'btnSubmit','btnLoading')" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            getData();
        });

        async function getData()
        {
            let param = {
                url: "{{ url()->current() }}",
                method: "GET",
                data: {
                    "load": "data-users"
                }
            }

            await transAjax(param).then((result) => {
                $("#team").html(result);
            }).catch((err) => {
                console.log(err);
            });
        }

        function editUser(user) {
            $("#updateUser").attr('action', '/wms/users/update/' + user.id);
            $("input[name=name]").val(user.name)
            $("input[name=email]").val(user.email)
            $("input[name=role]").val(user.role)
            $("input[name=whatsapp]").val(user.whatsapp)
            $("input[name=jabatan]").val(user.jabatan)
            $("input[name=team]").val(user.team)
            $("input[name=team]").val(user.team)
            $("input[name=team]").val(user.team)
            $("input[name=team]").val(user.team)
            //akun bank
            $("#namaPemilikRekening").val(user.bank.account_name)
            $("input[name=bank_code]").val(user.bank.bank_code)
            $("input[name=norek]").val(user.bank.account_number)
            $("#editUser").modal('show');
        }
    </script>
@endpush
