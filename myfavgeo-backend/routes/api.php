<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\PontoController;

Route::get('/teste', function (Request $request) {
    return response()->json(['message' => 'Hello, World']);
});

Route::middleware('auth:api')->group(function () {

    // Mapa Routes
    Route::get('/mapas', [MapaController::class, 'index']);
    Route::post('/mapas', [MapaController::class, 'store']);
    Route::get('/mapas/{id}', [MapaController::class, 'show']);
    Route::put('/mapas/{id}', [MapaController::class, 'update']);
    Route::delete('/mapas/{id}', [MapaController::class, 'destroy']);

    // Auth Routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

// Ponto Routes
Route::get('/pontos', [PontoController::class, 'index']);
Route::post('/pontos', [PontoController::class, 'store']);
Route::get('/pontos/{id}', [PontoController::class, 'show']);
Route::put('/pontos/{id}', [PontoController::class, 'update']);
Route::delete('/pontos/{id}', [PontoController::class, 'destroy']);

// User Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
