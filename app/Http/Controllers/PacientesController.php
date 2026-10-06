<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Paciente;

class PacientesController extends Controller
{
   /* public function index()
    {
        return view ('Pacientes.index');
    }**/
    public function show()
    {
        return view('pacientes.show');
    }
    public function create()
{
    return view('Pacientes.create');
}
    public function index()
    {
        $pacientes = Paciente::orderBy('nombre')->get();

        return view('Pacientes.index', compact('pacientes'));
    }   

public function store(Request $request)
{
    $validateData = $request->validate([
        'nombre' => 'required|string|max:255| min:3',
        'fecha_nacimiento' => 'required|date|before:today',
        'sexo' => 'required|in:M,F',
        'tipo_sangre' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
        'email' => 'required|email|unique:pacientes,email',
        'telefono' => 'required|string|max:20| min:8',
        'direccion' => 'required|string|max:255| min:10',
    ]);

    $paciente = new Paciente();
    $paciente->nombre = $validateData['nombre'];
    $paciente->fecha_nacimiento = $validateData['fecha_nacimiento'];
    $paciente->sexo = $validateData['sexo'];
    $paciente->tipo_sangre = $validateData['tipo_sangre'];
    $paciente->email = $validateData['email'];
    $paciente->telefono = $validateData['telefono'];
    $paciente->direccion = $validateData['direccion'];
    $paciente->save();

    return redirect()->route('Pacientes.index')->with('success', 'Paciente creado exitosamente.');
}
}
