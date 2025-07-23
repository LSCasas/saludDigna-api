<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DireccionController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\CitaController;

Route::apiResource('direcciones', DireccionController::class);
Route::apiResource('pacientes', PacienteController::class);
Route::apiResource('citas', CitaController::class);
