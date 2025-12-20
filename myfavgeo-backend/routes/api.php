<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\PontoController;

Route::get('/teste', function (Request $request) {
    return response()->json(['message' => 'Hello, World']);
});


// Mapa Routes
Route::get('/mapas', [MapaController::class, 'index']);
Route::post('/mapas', [MapaController::class, 'store']);
Route::get('/mapas/{id}', [MapaController::class, 'show']);
Route::put('/mapas/{id}', [MapaController::class, 'update']);
Route::delete('/mapas/{id}', [MapaController::class, 'destroy']);

// Ponto Routes
Route::get('/pontos', [PontoController::class, 'index']);
Route::post('/pontos', [PontoController::class, 'store']);
Route::get('/pontos/{id}', [PontoController::class, 'show']);
Route::put('/pontos/{id}', [PontoController::class, 'update']);
Route::delete('/pontos/{id}', [PontoController::class, 'destroy']);
