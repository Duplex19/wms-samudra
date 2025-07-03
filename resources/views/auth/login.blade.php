<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login Samudra Wasesa</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://samudrawasesa.co.id/assets/home/assets/img/samudra.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="alert alert-danger d-none" id="notifikasi">Email atau password salah</div>
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="text-center">
                <img src="{{ asset('assets/img/logo/samudra-wasesa.png') }}" alt="logo" width="30%">
              </div>
              <div class="app-brand justify-content-center">
                  <span class="app-brand-text demo text-body fw-bolder mt-2">Samudra Wasesa</span>
              </div>
              <!-- /Logo -->
              <p class="mb-4">Silakan login menggunakan email dan password</p>

              <form id="formAuthentication" class="mb-3">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    autofocus
                    required
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="#">
                      <small>Lupa Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Ingat saya </label>
                  </div>
                </div>
                <div class="mb-3">
                  <x-btnLoading id="btnLoading" width="w-100" />
                  <x-btnSubmit id="btnSubmit" width="w-100" text="Masuk" />
                </div>
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $('#formAuthentication').on('submit', function (e) {
        e.preventDefault();

        loading(true);
        $.ajax({
            url: '/login',
            method: 'POST',
            data: {
            email: $('#email').val(),
            password: $('#password').val()
            },
            success: function (response) {
            if (response.success) {
               loading(false);
                window.location.href = '/wms/dashboard';
            } else {
                loading(false);
                $("#notifikasi").removeClass('d-none');
            }
            },
            error: function (xhr) {
            loading(false);
            const err = xhr.responseJSON?.message || 'Terjadi kesalahan server';
            $("#notifikasi").removeClass('d-none');
            }
          });
        });

        function loading(state)
        {
          if(state) {
            $("#btnSubmit").addClass('d-none');
            $("#btnLoading").removeClass('d-none');
          }else {
            $("#btnSubmit").removeClass('d-none');
            $("#btnLoading").addClass('d-none');
          }
        }
    });
    </script>
  </body>
</html>
