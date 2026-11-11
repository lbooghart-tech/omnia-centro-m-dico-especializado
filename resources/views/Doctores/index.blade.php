@extends('layouts.app')

@section('content')

<div class="w-full px-4 bg-clinica-50 min-h-screen pb-10">

    <h1 class="text-2xl font-bold py-3">Doctores</h1>

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('Doctores.create') }}"
           class="bg-clinica-600 hover:bg-clinica-900 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            Crear nuevo doctor
        </a>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Especialidad</th>
                <th class="border px-4 py-2">Horario</th>
                <th class="border px-4 py-2">Colegiado</th>
                <th class="border px-4 py-2">Teléfono</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($doctores as $doctor)
                <tr>
                    <td class="border px-4 py-2">{{ $doctor->nombre }}</td>
                    <td class="border px-4 py-2">{{ $doctor->especialidad }}</td>
                    <td class="border px-4 py-2">{{ $doctor->horario }}</td>
                    <td class="border px-4 py-2">{{ $doctor->colegiado }}</td>
                    <td class="border px-4 py-2">{{ $doctor->telefono }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('Doctores.edit', $doctor->id) }}"
                           class="bg-clinica-400 hover:bg-clinica-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="border px-4 py-2" colspan="6">No hay doctores registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection