<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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
Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/pacientes/activos/count', [PacienteController::class, 'countActivePatients']);
    Route::get('/pacientes/inactivos/count', [PacienteController::class, 'countInactivePatients']);

    Route::apiResource('pacientes', PacienteController::class);
    Route::apiResource('citas', CitaController::class);
    Route::apiResource('recetas', RecetaController::class);
    Route::get('/recetas/{id}/completa', [RecetaController::class, 'showRecetaWithPacienteData']);
    Route::get('/recetas/paciente/{id_paciente}', [RecetaController::class, 'getRecetasPorPaciente']);
    Route::get('/citasCompletas', [CitaController::class, 'citaConPaciente']);
    Route::get('/ultimosDatos', [PacienteController::class, 'pacientesConUltimosDatos']);

    Route::get('/user', [AuthController::class, 'me']);
});
