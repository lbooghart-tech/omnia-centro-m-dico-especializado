<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoctoresController extends Controller
{
    public function index()
    {
        $doctores = Doctor::all();
        return view('Doctores.index', compact('doctores'));
    }

    public function create()
    {
        return view('Doctores.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate($this->reglas(), $this->mensajes());

        $doctor = new Doctor();
        $doctor->nombre       = $validateData['nombre'];
        $doctor->especialidad = $validateData['especialidad'];
        $doctor->horario      = $validateData['horario'];
        $doctor->colegiado    = $validateData['colegiado'];
        $doctor->telefono     = $validateData['telefono'];
        $doctor->save();

        return redirect()->route('Doctores.index')->with('success', 'Doctor creado exitosamente.');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('Doctores.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validateData = $request->validate($this->reglas($doctor->id), $this->mensajes());

        $doctor->nombre       = $validateData['nombre'];
        $doctor->especialidad = $validateData['especialidad'];
        $doctor->horario      = $validateData['horario'];
        $doctor->colegiado    = $validateData['colegiado'];
        $doctor->telefono     = $validateData['telefono'];
        $doctor->save();

        return redirect()->route('Doctores.index')->with('success', 'Doctor actualizado exitosamente.');
    }

    private function reglas($id = null): array
    {
        return [
            'nombre'       => ['required', 'string', 'max:255'],
            'especialidad' => ['required', 'string', 'max:255'],
            'horario'      => ['required', 'in:AM,PM'],
            'colegiado'    => ['required', 'string', 'max:20', Rule::unique('doctors', 'colegiado')->ignore($id)],
            'telefono'     => ['required', 'string', 'max:20'],
        ];
    }

    private function mensajes(): array
    {
        return [
            'colegiado.unique' => 'Ya existe un doctor con este número de colegiado.',
            'horario.in'       => 'Seleccione un horario válido (AM o PM).',
        ];
    }
}