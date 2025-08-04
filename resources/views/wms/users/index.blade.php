@extends('layouts.app')
@section('content')
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addVpnServer"><i class="menu-icon icon-base bx bx-user"></i>
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
@endsection
@push('js')
    <script>
        $(document).ready(async function() {
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
        });
    </script>
@endpush
