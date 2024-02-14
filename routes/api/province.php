<?php

use App\Http\Controllers\ProvinceController;
use Illuminate\Http\Request;

Route::get('provinces', [ProvinceController::class, 'index']);
Route::post('provinces', [ProvinceController::class, 'store']);
Route::put('provinces/{id}', [ProvinceController::class, 'edit']);
Route::delete('provinces/{id}', [ProvinceController::class, 'destroy']);
Route::get('provinces/{id}', [ProvinceController::class, 'provincesForRegion']);
