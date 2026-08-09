<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


route::get('/pacientes', 
[App\Http\Controllers\PacientesController::class, 'index'])->name('Pacientes.index');