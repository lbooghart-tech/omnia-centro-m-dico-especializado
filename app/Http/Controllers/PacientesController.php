<?php
namespace App\Http\Controllers;

class PacientesController extends Controller
{
    public function index()
    {
        return view ('Pacientes.index');
    }
    public function show()
    {
        return view('pacientes.show');
    }
}
