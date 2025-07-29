<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DireccionController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\CitaController;
use App\Http\Controllers\Api\RecetaController;



/**
 * Rutas públicas
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/**
 * Rutas protegidas
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('direcciones', DireccionController::class);
    Route::apiResource('pacientes', PacienteController::class);
    Route::apiResource('citas', CitaController::class);
    Route::apiResource('recetas', RecetaController::class);
});
