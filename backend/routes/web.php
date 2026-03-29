<?php

use App\Http\Controllers\AlumnoPdfController;
use App\Http\Controllers\DocentePdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/alumnos/{alumno}/pdf', [AlumnoPdfController::class, 'descargar'])
        ->name('alumnos.pdf');
    Route::get('/docentes/{docente}/pdf', [DocentePdfController::class, 'descargar'])
        ->name('docentes.pdf');
});
