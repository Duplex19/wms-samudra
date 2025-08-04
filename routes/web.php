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

            Route::controller(WMS\Config\ProfilePppController::class)->group(function() {
                Route::get('/profile_ppp', 'index')->name('wms.profile_ppp');
                Route::post('/profile_ppp', 'store')->name('wms.profile_ppp.store');
                Route::get('/profile_ppp/edit/{id}', 'edit')->name('wms.profile_ppp.edit');
                Route::post('/profile_ppp/update/{id}', 'update')->name('wms.profile_ppp.update');
                Route::delete('/profile_ppp/delete/{id}', 'delete')->name('wms.profile_ppp.delete');
            });

            Route::controller(WMS\Config\PppoeController::class)->group(function() {
                Route::get('/pppoe', 'index')->name('wms.pppoe');
                Route::post('/pppoe', 'store')->name('wms.pppoe.store');
                Route::get('/pppoe/edit/{id}', 'edit')->name('wms.pppoe.edit');
                Route::post('/pppoe/update/{id}', 'update')->name('wms.pppoe.update');
                Route::delete('/pppoe/delete/{id}', 'delete')->name('wms.pppoe.delete');
                Route::post('/pppoe/update_status/{id}', 'setStatus')->name('wms.pppoe.update_status');
            });
            
            Route::controller(WMS\Config\VPNController::class)->group(function() {
                Route::get('/vpn', 'index')->name('wms.vpn');
                Route::post('/vpn/store', 'store')->name('wms.vpn.store');
                Route::delete('/vpn/delete', 'delete')->name('wms.vpn.delete');
            });

            //route untuk billing
            // Route::controller(WMS\Config\BillingController::class)->group(function() {
            //     Route::get('/setting', 'index')->name('wms.billing');
            //     Route::put('/pengaturan_penagihan/update/{id}', 'update')->name('wms.billing.update');
            // });

            //route untuk setting
            Route::controller(WMS\Config\SettingController::class)->group(function() {
                Route::get('/setting/sechedule', 'sechedule')->name('wms.sechedule');
                Route::post('/setting/sechedule/update/{id}', 'secheduleUpdate')->name('wms.sechedule.update');
                Route::get('/setting/billing', 'billing')->name('wms.billing');
                Route::put('/pengaturan_penagihan/update/{id}', 'update')->name('wms.billing.update');
                Route::get('/setting/registration', 'registration')->name('wms.registration');
                Route::post('/setting/registration/status/update', 'registrationUpdate')->name('wms.registration.update');
                Route::post('/setting/registration/price/update', 'registrationPrice')->name('wms.registration.price');
            });

            //route template WhatasApp
            Route::controller(WMS\Config\TemplateController::class)->group(function() {
                Route::get('/template_whatsapp', 'index')->name('wms.templateWhatsapp');
            });
        });

        //route froup member
        Route::prefix('member')->group(function() {
            Route::controller(WMS\Member\InvoiceController::class)->group(function() {
                Route::get('/invoice', 'index')->name('wms.member.invoice');
                Route::post('/invoice/send_reminder/{id}', 'sendReminder')->name('wms.member.invoice.send_reminder');
                Route::post('/invoice/payment/{id}', 'payment')->name('wms.member.invoice.payment');
                Route::post('/invoice/update/{id}', 'paymentUpdate')->name('wms.member.invoice.paymentUpdate');
                Route::post('/invoice/create_invoice', 'createInvoice')->name('wms.member.invoice.create');
                Route::delete('/invoice/delete/{id}', 'delete')->name('wms.member.invoice.delete');
            });

            Route::controller(WMS\Member\CustomerController::class)->group(function() {
                Route::get('/customer', 'index')->name('wms.member.customer');
                Route::put('/customer/{id}', 'update')->name('wms.member.customer.update');
            });

        });

        //route for employee
        Route::prefix('users')->group(function() {
            Route::controller(WMS\Users\UserController::class)->group(function() {
                Route::get('/', 'index')->name('wms.users.index');
            });
        });

        //route log aktivitas user
        Route::get('/services/log', WMS\Services\LogController::class)->name('wms.log');

        //route untuk keluar aplikasi
        Route::post('/logout', [Auth\AuthController::class, 'logout'])->name('wms.logout');
    });
});

