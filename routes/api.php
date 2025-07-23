<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DireccionController;

Route::apiResource('direcciones', DireccionController::class);
