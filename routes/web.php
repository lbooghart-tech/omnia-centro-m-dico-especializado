<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


route::get('/pacientes', 
[App\Http\Controllers\PacientesController::class, 'index'])->name('Pacientes.index');

route::get('/pacientes/show', 
[App\Http\Controllers\PacientesController::class, 'show'])->name('Pacientes.show');

route::get('/pacientes/create',
[App\Http\Controllers\PacientesController::class, 'create'])->name('Pacientes.create');

Route::post('/pacientes/store',
[App\Http\Controllers\PacientesController::class, 'store'])->name('Pacientes.store');