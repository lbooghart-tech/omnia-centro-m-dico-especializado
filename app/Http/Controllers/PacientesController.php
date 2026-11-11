<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Validation\Rule;

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
        'dpi' => ['required', 'integer', 'digits:13', 'unique:pacientes,dpi'],
        'fecha_nacimiento' => 'required|date|before:today',
        'sexo' => 'required|in:M,F',
        'tipo_sangre' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
        'email' => 'required|email|unique:pacientes,email',
        'telefono' => 'required|string|max:20| min:8',
        'direccion' => 'required|string|max:255| min:10',
    ]);

    $paciente = new Paciente();
    $paciente->nombre = $validateData['nombre'];
    $paciente->dpi = $validateData['dpi'];
    $paciente->fecha_nacimiento = $validateData['fecha_nacimiento'];
    $paciente->sexo = $validateData['sexo'];
    $paciente->tipo_sangre = $validateData['tipo_sangre'];
    $paciente->email = $validateData['email'];
    $paciente->telefono = $validateData['telefono'];
    $paciente->direccion = $validateData['direccion'];
    $paciente->save();

    return redirect()->route('Pacientes.index')->with('success', 'Paciente creado exitosamente.');
}
public function edit($id)
{
    $paciente = Paciente::findOrFail($id);
    return view('Pacientes.edit', compact('paciente'));
}

public function update(Request $request, $id)
{
    $paciente = Paciente::findOrFail($id);

    $validateData = $request->validate([
        'nombre'           => ['required', 'string', 'max:255'],
        'dpi'              => ['required', 'integer', 'digits:13', Rule::unique('pacientes', 'dpi')->ignore($paciente->id)],
        'fecha_nacimiento' => ['required', 'date'],
        'sexo'             => ['required', 'in:M,F'],
        'tipo_sangre'      => ['nullable', 'in:A+,A-,B+,B-,AB+,AB-,O+,O-'],
        'email'            => ['required', 'email', Rule::unique('pacientes', 'email')->ignore($paciente->id)],
        'telefono'         => ['required', 'string', 'max:20'],
        'direccion'        => ['required', 'string', 'max:255'],
    ], [
        'dpi.required' => 'El DPI es obligatorio.',
        'dpi.integer'  => 'El DPI debe ser un número entero, sin espacios ni guiones.',
        'dpi.digits'   => 'El DPI debe tener exactamente 13 dígitos, sin espacios ni guiones.',
        'dpi.unique'   => 'Ya existe un paciente con este DPI.',
    ]);

    $paciente->nombre           = $validateData['nombre'];
    $paciente->dpi              = $validateData['dpi'];
    $paciente->fecha_nacimiento = $validateData['fecha_nacimiento'];
    $paciente->sexo             = $validateData['sexo'];
    $paciente->tipo_sangre      = $validateData['tipo_sangre'];
    $paciente->email            = $validateData['email'];
    $paciente->telefono         = $validateData['telefono'];
    $paciente->direccion        = $validateData['direccion'];
    $paciente->save();

    return redirect()->route('Pacientes.index')->with('success', 'Paciente actualizado exitosamente.');
}
}
