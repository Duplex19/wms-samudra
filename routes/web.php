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

        Route::prefix('config')->group(function() {
            Route::controller(WMS\Config\RouterController::class)->group(function() {
                Route::get('/router', 'index')->name('wms.router');
                Route::post('/router', 'store')->name('wms.router.store');
                Route::get('/router/edit/{id}', 'edit')->name('wms.router.edit');
                Route::post('/router/update/{id}', 'update')->name('wms.router.update');
                Route::delete('/router/delete/{id}', 'delete')->name('wms.router.delete');
                Route::post('/router/connection_check/{id}', 'ping');
            });
            
            Route::controller(WMS\Config\VPNController::class)->group(function() {
                Route::get('/vpn', 'index')->name('wms.vpn');
                Route::post('/vpn/store', 'store')->name('wms.vpn.store');
                Route::delete('/vpn/delete', 'delete')->name('wms.vpn.delete');
            });
        });

        //route untuk keluar aplikasi
        Route::post('/logout', [Auth\AuthController::class, 'logout'])->name('wms.logout');
    });
});

