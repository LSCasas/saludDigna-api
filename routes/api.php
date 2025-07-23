<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DireccionController;
use App\Http\Controllers\Api\PacienteController;

Route::apiResource('direcciones', DireccionController::class);
Route::apiResource('pacientes', PacienteController::class);
