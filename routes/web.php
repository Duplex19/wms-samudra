<?php
namespace App\Http\Controllers;

use App\Http\Middleware\AuthApi;
use App\Http\Middleware\ApiGuest;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiGuest::class)->group(function() {
    Route::view('/', 'auth.login')->name('login');
    Route::post('/login', [Auth\AuthController::class, 'login']);
});

Route::middleware(AuthApi::class)->group(function() {
    Route::prefix('wms')->group(function() {
        Route::get('/dashboard', WMS\DashboardController::class)->name('wms.dashboard');

        //route untuk keluar aplikasi
        Route::post('/logout', [Auth\AuthController::class, 'logout'])->name('wms.logout');
    });
});

