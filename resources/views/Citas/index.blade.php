@extends('layouts.app')

@section('content')

<div class="w-full px-4 bg-clinica-50 min-h-screen pb-10">

    <h1 class="text-2xl font-bold py-3">Citas</h1>

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('Citas.create') }}"
           class="bg-clinica-600 hover:bg-clinica-900 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            Agendar nueva cita
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-300 text-left">
        <thead>
        <tr>
            <th class="py-2 px-4 border-b">Fecha</th>
            <th class="py-2 px-4 border-b">Hora</th>
            <th class="py-2 px-4 border-b">Paciente</th>
            <th class="py-2 px-4 border-b">DPI</th>
            <th class="py-2 px-4 border-b">Teléfono</th>
            <th class="py-2 px-4 border-b">Doctor</th>
            <th class="py-2 px-4 border-b">Especialidad</th>
            <th class="py-2 px-4 border-b">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($citas as $cita)
            <tr>
                <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::createFromFormat('H:i', substr($cita->hora, 0, 5))->format('h:i A') }}</td>
                <td class="py-2 px-4 border-b">{{ $cita->paciente->nombre }}</td>
                <td class="py-2 px-4 border-b">{{ $cita->paciente->dpi }}</td>
                <td class="py-2 px-4 border-b">{{ $cita->paciente->telefono }}</td>
                <td class="py-2 px-4 border-b">{{ $cita->doctor->nombre }}</td>
                <td class="py-2 px-4 border-b">{{ $cita->doctor->especialidad }}</td>
                <td class="py-2 px-4 border-b">
                    <form method="POST" action="{{ route('Citas.destroy', $cita->id) }}"
                          onsubmit="return confirm('¿Cancelar esta cita?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="background-color: #b91c1c; color: white; font-size: 14px; font-weight: 600; padding: 8px 16px; border-radius: 8px;">
                            Cancelar
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td class="py-2 px-4 border-b" colspan="8">No hay citas agendadas.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

@endsection