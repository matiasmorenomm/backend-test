<?php

use App\Http\Controllers\RegionController;
use Illuminate\Http\Request;

Route::get('regions', [RegionController::class, 'index']);
Route::post('regions', [RegionController::class, 'store']);
Route::put('regions/{id}', [RegionController::class, 'edit']);
Route::delete('regions/{id}', [RegionController::class, 'destroy']);
