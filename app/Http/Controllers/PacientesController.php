<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

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
    public function create()
{
    return view('Pacientes.create');
}

public function store(Request $request)
{
    $validateData = $request->validate([
        'nombre' => 'required|string|max:255| min:3',
        'apellido' => 'required|string|max:255| min:3',
        'telefono' => 'required|string|max:20| min:10',
        'direccion' => 'required|string|max:255| min:10',
    ]);

    $paciente = new Paciente();
    $paciente->nombre = $validateData['nombre'];
    $paciente->apellido = $validateData['apellido'];
    $paciente->telefono = $validateData['telefono'];
    $paciente->direccion = $validateData['direccion'];
    $paciente->save();

    return redirect()->route('Pacientes.index')->with('success', 'Paciente creado exitosamente.');
}
}
