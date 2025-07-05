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
    </style>
@endpush
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 col-12 mb-4">
        <div class="card gradient-card">
            <div class="card-body card-content">
                <div class="d-flex align-items-center">
                    <div class="icon-container">
                        <i class="tf-icons bx bx-user-plus"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white">852</h2>
                        <p class="card-label">Total</p>
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
                        <h2 class="card-number text-white">835</h2>
                        <p class="card-label">Aktif</p>
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
                        <h2 class="card-number text-white">17</h2>
                        <p class="card-label">Ditangguhkan</p>
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
                        <i class="tf-icons bx bx-user-voice"></i>
                    </div>
                    <div>
                        <h2 class="card-number text-white">799</h2>
                        <p class="card-label">Online</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <h5 class="card-header">Filter data user</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <select name="" id="" class="form-select">
                    <option value="">Nas</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="" id="" class="form-select">
                    <option value="">Status</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="" id="" class="form-select">
                    <option value="">Profil</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="" id="" class="form-select">
                    <option value="">Perhalaman</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <button class="btn btn-outline-primary mb-3"><i class="tf-icons bx bx-user-plus"></i> Tambah pengguna</button>
        <button class="btn btn-outline-primary mb-3"><i class="tf-icons bx bx-cog"></i></button>
        <button class="btn btn-outline-primary mb-3"><i class="tf-icons bx bx-slider"></i></button>
        <button class="btn btn-outline-primary mb-3"><i class="tf-icons bx bx-trash"></i></button>
        <div class="table-responsive text-nowrap mt-3">
            <table class="table table-sm">
        <thead class="table-light">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Type</th>
            <th scope="col">Username</th>
            <th scope="col">Password</th>
            <th scope="col">Profile</th>
            <th scope="col">Nas</th>
            <th scope="col">Status</th>
            <th scope="col">Internet</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>PPPoE</td>
                <td>644.bainah@primadona</td>
                <td>12345678</td>
                <td>PAKET PROMO KEMENANGAN</td>
                <td>DIST-PRIMADONA-RETAIL-VM</td>
                <td><span class="badge bg-success rounded-pill">Aktif</span></td>
                    <td><span class="badge bg-success rounded-pill">Online</span></td>
                <td><span class="btn btn-primary btn-sm">lihat</span></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>PPPoE</td>
                <td>644.bainah@primadona</td>
                <td>12345678</td>
                <td>PAKET PROMO KEMENANGAN</td>
                <td>DIST-PRIMADONA-RETAIL-VM</td>
                <td><span class="badge bg-success rounded-pill">Aktif</span></td>
                    <td><span class="badge bg-warning rounded-pill">Isolir</span></td>
                <td><span class="btn btn-primary btn-sm">lihat</span></td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>PPPoE</td>
                <td>644.bainah@primadona</td>
                <td>12345678</td>
                <td>PAKET PROMO KEMENANGAN</td>
                <td>DIST-PRIMADONA-RETAIL-VM</td>
                <td><span class="badge bg-success rounded-pill">Aktif</span></td>
                    <td><span class="badge bg-success rounded-pill">Online</span></td>
                <td><span class="btn btn-primary btn-sm">lihat</span></td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>PPPoE</td>
                <td>644.bainah@primadona</td>
                <td>12345678</td>
                <td>PAKET PROMO KEMENANGAN</td>
                <td>DIST-PRIMADONA-RETAIL-VM</td>
                <td><span class="badge bg-success rounded-pill">Aktif</span></td>
                    <td><span class="badge bg-success rounded-pill">Online</span></td>
                <td><span class="btn btn-primary btn-sm">lihat</span></td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td>PPPoE</td>
                <td>644.bainah@primadona</td>
                <td>12345678</td>
                <td>PAKET PROMO KEMENANGAN</td>
                <td>DIST-PRIMADONA-RETAIL-VM</td>
                <td><span class="badge bg-success rounded-pill">Aktif</span></td>
                    <td><span class="badge bg-success rounded-pill">Online</span></td>
                <td><span class="btn btn-primary btn-sm">lihat</span></td>
            </tr>
            <tr>
                <th scope="row">6</th>
                <td>PPPoE</td>
                <td>644.bainah@primadona</td>
                <td>12345678</td>
                <td>PAKET PROMO KEMENANGAN</td>
                <td>DIST-PRIMADONA-RETAIL-VM</td>
                <td><span class="badge bg-success rounded-pill">Aktif</span></td>
                    <td><span class="badge bg-success rounded-pill">Online</span></td>
                <td><span class="btn btn-primary btn-sm">lihat</span></td>
            </tr>
            <tr>
                <th scope="row">7</th>
                <td>PPPoE</td>
                <td>644.bainah@primadona</td>
                <td>12345678</td>
                <td>PAKET PROMO KEMENANGAN</td>
                <td>DIST-PRIMADONA-RETAIL-VM</td>
                <td><span class="badge bg-success rounded-pill">Aktif</span></td>
                    <td><span class="badge bg-success rounded-pill">Online</span></td>
                <td><span class="btn btn-primary btn-sm">lihat</span></td>
            </tr>
            <tr>
                <th scope="row">8</th>
                <td>PPPoE</td>
                <td>644.bainah@primadona</td>
                <td>12345678</td>
                <td>PAKET PROMO KEMENANGAN</td>
                <td>DIST-PRIMADONA-RETAIL-VM</td>
                <td><span class="badge bg-success rounded-pill">Aktif</span></td>
                <td><span class="badge bg-success rounded-pill">Online</span></td>
                <td><span class="btn btn-primary btn-sm">lihat</span></td>
            </tr>
            <tr>
                <th scope="row">9</th>
                <td>PPPoE</td>
                <td>644.bainah@primadona</td>
                <td>12345678</td>
                <td>PAKET PROMO KEMENANGAN</td>
                <td>DIST-PRIMADONA-RETAIL-VM</td>
                <td><span class="badge bg-success rounded-pill">Aktif</span></td>
                    <td><span class="badge bg-success rounded-pill">Online</span></td>
                <td><span class="btn btn-primary btn-sm">lihat</span></td>
            </tr>
            <tr>
                <th scope="row">10</th>
                <td>PPPoE</td>
                <td>644.bainah@primadona</td>
                <td>12345678</td>
                <td>PAKET PROMO KEMENANGAN</td>
                <td>DIST-PRIMADONA-RETAIL-VM</td>
                <td><span class="badge bg-success rounded-pill">Aktif</span></td>
                    <td><span class="badge bg-success rounded-pill">Online</span></td>
                <td><span class="btn btn-primary btn-sm">lihat</span></td>
            </tr>
        </tbody>
        </table>
        </div>
    </div>
</div>
@endsection