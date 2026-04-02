<?php

use App\Http\Controllers\AlumnoPdfController;
use App\Http\Controllers\DocentePdfController;
use App\Http\Controllers\HorarioPdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/alumnos/{alumno}/pdf', [AlumnoPdfController::class, 'descargar'])
        ->name('alumnos.pdf');
    Route::get('/docentes/{docente}/pdf', [DocentePdfController::class, 'descargar'])
        ->name('docentes.pdf');
    Route::get('/horarios/{curso}/pdf', [HorarioPdfController::class, 'descargar'])
        ->name('horarios.pdf');
});
