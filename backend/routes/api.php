<?php

use App\Http\Controllers\Api\ConsultaController;
use App\Http\Controllers\Api\NoticiaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Noticias - GET (público)
Route::get('/noticias', [NoticiaController::class, 'index']);
Route::get('/noticias/{slug}', [NoticiaController::class, 'show']);

// Noticias - CRUD completo (privado - requiere autenticación)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/noticias', [NoticiaController::class, 'store']);
    Route::put('/noticias/{noticia}', [NoticiaController::class, 'update']);
    Route::delete('/noticias/{noticia}', [NoticiaController::class, 'destroy']);
});

Route::post('/consultas', [ConsultaController::class, 'store']);
