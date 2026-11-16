<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    private const DIAS_ADELANTE = 30;

    public function index()
    {
        $citas = Cita::with(['paciente', 'doctor'])
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('Citas.index', compact('citas'));
    }

    public function create()
    {
        $doctores = Doctor::orderBy('nombre')->get();
        return view('Citas.create', compact('doctores'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'dpi'       => ['required', 'integer', 'digits:13', 'exists:pacientes,dpi'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'fecha'     => ['required', 'date_format:Y-m-d'],
            'hora'      => ['required', 'date_format:H:i'],
        ], [
            'dpi.required'      => 'El DPI es obligatorio.',
            'dpi.integer'       => 'El DPI debe ser un número entero, sin espacios ni guiones.',
            'dpi.digits'        => 'El DPI debe tener exactamente 13 dígitos, sin espacios ni guiones.',
            'dpi.exists'        => 'No existe un paciente registrado con ese DPI. Regístrelo primero en Pacientes.',
            'doctor_id.required' => 'Seleccione un doctor.',
            'fecha.required'    => 'Seleccione una fecha.',
            'hora.required'     => 'Seleccione una hora.',
        ]);

        $paciente = Paciente::where('dpi', $validateData['dpi'])->firstOrFail();
        $doctor   = Doctor::findOrFail($validateData['doctor_id']);

        // Vuelve a comprobar en el servidor que la hora siga libre
        $libres = $this->calcularDisponibilidad($doctor, $paciente->id);

        if (! in_array($validateData['hora'], $libres[$validateData['fecha']] ?? [], true)) {
            return back()->withInput()->withErrors([
                'hora' => 'Ese horario no está disponible: el doctor o el paciente ya tienen una cita a esa hora.',
            ]);
        }

        try {
            $cita = new Cita();
            $cita->paciente_id = $paciente->id;
            $cita->doctor_id   = $doctor->id;
            $cita->fecha       = $validateData['fecha'];
            $cita->hora        = $validateData['hora'];
            $cita->save();
        } catch (UniqueConstraintViolationException $e) {
            // Alguien más reservó esa hora un instante antes
            return back()->withInput()->withErrors([
                'hora' => 'Esa hora acaba de ser ocupada. Elija otra.',
            ]);
        }

        return redirect()->route('Citas.index')->with('success', 'Cita agendada exitosamente.');
    }

    public function destroy($id)
    {
        Cita::findOrFail($id)->delete();

        return redirect()->route('Citas.index')->with('success', 'Cita cancelada.');
    }

    // Devuelve nombre y teléfono del paciente a partir del DPI
    public function buscarPaciente($dpi)
    {
        $paciente = Paciente::where('dpi', $dpi)->first();

        if (! $paciente) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json([
            'nombre'   => $paciente->nombre,
            'telefono' => $paciente->telefono,
        ]);
    }

    // Devuelve { "2026-11-16": ["08:00", "09:00"], ... } con lo disponible
    public function disponibilidad(Request $request)
    {
        $doctor = Doctor::find($request->query('doctor_id'));

        if (! $doctor) {
            return response()->json([]);
        }

        $paciente = null;
        if ($request->filled('dpi')) {
            $paciente = Paciente::where('dpi', $request->query('dpi'))->first();
        }

        return response()->json($this->calcularDisponibilidad($doctor, $paciente?->id));
    }

    private function calcularDisponibilidad(Doctor $doctor, ?int $pacienteId = null): array
    {
        $ahora  = now();
        $inicio = $ahora->copy()->startOfDay();
        $fin    = $inicio->copy()->addDays(self::DIAS_ADELANTE);

        // Horas ya ocupadas por el doctor o por el paciente
        $ocupadas = Cita::whereBetween('fecha', [$inicio->toDateString(), $fin->toDateString()])
            ->where(function ($q) use ($doctor, $pacienteId) {
                $q->where('doctor_id', $doctor->id);
                if ($pacienteId) {
                    $q->orWhere('paciente_id', $pacienteId);
                }
            })
            ->get(['fecha', 'hora'])
            ->map(fn ($c) => substr($c->fecha, 0, 10) . ' ' . substr($c->hora, 0, 5))
            ->flip()
            ->all();

        // Horarios de atención: citas de 1 hora, la última empieza a las 16:00
        $horas = $doctor->horario === 'AM'
            ? ['08:00', '09:00', '10:00', '11:00']
            : ['12:00', '13:00', '14:00', '15:00', '16:00'];

        $resultado = [];

        for ($dia = $inicio->copy(); $dia->lte($fin); $dia->addDay()) {
            if ($dia->isWeekend()) {
                continue;
            }

            $fecha  = $dia->toDateString();
            $libres = [];

            foreach ($horas as $hora) {
                // Hoy no se ofrecen horas que ya empezaron
                if ($fecha === $ahora->toDateString() && $hora <= $ahora->format('H:i')) {
                    continue;
                }
                if (isset($ocupadas["$fecha $hora"])) {
                    continue;
                }
                $libres[] = $hora;
            }

            if ($libres) {
                $resultado[$fecha] = $libres;
            }
        }

        return $resultado;
    }
}