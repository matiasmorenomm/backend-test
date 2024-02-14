<?php

use App\Http\Controllers\StreetController;
use Illuminate\Http\Request;

Route::get('streets', [StreetController::class, 'index']);
Route::post('streets', [StreetController::class, 'store']);
Route::put('streets/{id}', [StreetController::class, 'edit']);
Route::delete('streets/{id}', [StreetController::class, 'destroy']);
