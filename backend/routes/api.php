<?php

use App\Http\Controllers\Api\ConsultaController;
use App\Http\Controllers\Api\NoticiaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/noticias', [NoticiaController::class, 'index']);
Route::get('/noticias/{slug}', [NoticiaController::class, 'show']);

Route::post('/consultas', [ConsultaController::class, 'store']);
