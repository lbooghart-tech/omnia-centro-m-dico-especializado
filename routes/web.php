<?php

use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pacientes', [PacientesController::class, 'index'])->name('Pacientes.index');
Route::get('/pacientes/show', [PacientesController::class, 'show'])->name('Pacientes.show');
Route::get('/pacientes/create', [PacientesController::class, 'create'])->name('Pacientes.create');
Route::post('/pacientes/store', [PacientesController::class, 'store'])->name('Pacientes.store');
Route::get('/pacientes/{id}/edit', [PacientesController::class, 'edit'])->name('Pacientes.edit');
Route::put('/pacientes/{id}', [PacientesController::class, 'update'])->name('Pacientes.update');