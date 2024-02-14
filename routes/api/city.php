<?php

use App\Http\Controllers\CityController;
use Illuminate\Http\Request;

Route::get('cities', [CityController::class, 'index']);
Route::post('cities', [CityController::class, 'store']);
Route::put('cities/{id}', [CityController::class, 'edit']);
Route::delete('cities/{id}', [CityController::class, 'destroy']);
Route::get('cities/{id}', [CityController::class, 'citiesForProvince']);
