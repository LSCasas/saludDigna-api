<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


/**
 * Rutas públicas
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
