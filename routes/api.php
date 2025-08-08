<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//clear cache
Route::post('/wms/cache_clear', App\Http\Controllers\WMS\CacheController::class);
