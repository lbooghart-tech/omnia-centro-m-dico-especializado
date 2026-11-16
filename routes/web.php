<?php

use App\Http\Controllers\PacientesController;
use App\Http\Controllers\DoctoresController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pacientes', [PacientesController::class, 'index'])->name('Pacientes.index');
Route::get('/pacientes/show', [PacientesController::class, 'show'])->name('Pacientes.show');
Route::get('/pacientes/create', [PacientesController::class, 'create'])->name('Pacientes.create');
Route::post('/pacientes/store', [PacientesController::class, 'store'])->name('Pacientes.store');
Route::get('/pacientes/{id}/edit', [PacientesController::class, 'edit'])->name('Pacientes.edit');
Route::put('/pacientes/{id}', [PacientesController::class, 'update'])->name('Pacientes.update');
Route::get('/doctores', [DoctoresController::class, 'index'])->name('Doctores.index');
Route::get('/doctores/create', [DoctoresController::class, 'create'])->name('Doctores.create');
Route::post('/doctores/store', [DoctoresController::class, 'store'])->name('Doctores.store');
Route::get('/doctores/{id}/edit', [DoctoresController::class, 'edit'])->name('Doctores.edit');
Route::put('/doctores/{id}', [DoctoresController::class, 'update'])->name('Doctores.update');
Route::get('/citas', [CitasController::class, 'index'])->name('Citas.index');
Route::get('/citas/create', [CitasController::class, 'create'])->name('Citas.create');
Route::post('/citas/store', [CitasController::class, 'store'])->name('Citas.store');
Route::get('/citas/disponibilidad', [CitasController::class, 'disponibilidad'])->name('Citas.disponibilidad');
Route::get('/citas/paciente/{dpi}', [CitasController::class, 'buscarPaciente'])->name('Citas.paciente');
Route::delete('/citas/{id}', [CitasController::class, 'destroy'])->name('Citas.destroy');