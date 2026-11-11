@extends('layouts.app')

@section('title', 'Pacientes')

@section('content')
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
@endif
    <h2 class="text-2xl font-bold text-clinica-900 mb-4">Pacientes</h2>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
        <tr>
            <th class="py-2 px-4 border-b">Nombre</th>
            <th class="py-2 px-4 border-b">DPI</th>
            <th class="py-2 px-4 border-b">Fecha de Nacimiento</th>
            <th class="py-2 px-4 border-b">Sexo</th>
            <th class="py-2 px-4 border-b">Tipo de Sangre</th>
            <th class="py-2 px-4 border-b">Email</th>
            <th class="py-2 px-4 border-b">Teléfono</th>
            <th class="py-2 px-4 border-b">Dirección</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pacientes as $paciente)
            <tr>
                <td class="py-2 px-4 border-b">{{ $paciente->nombre }}</td>
                <td class="py-2 px-4 border-b">{{ $paciente->dpi }}</td>
                <td class="py-2 px-4 border-b">{{ $paciente->fecha_nacimiento }}</td>
                <td class="py-2 px-4 border-b">{{ $paciente->sexo }}</td>
                <td class="py-2 px-4 border-b">{{ $paciente->tipo_sangre ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $paciente->email }}</td>
                <td class="py-2 px-4 border-b">{{ $paciente->telefono }}</td>
                <td class="py-2 px-4 border-b">{{ $paciente->direccion }}</td>
                <td>
                <a href="{{ route('Pacientes.edit', $paciente->id) }}"
                class="bg-clinica-400 hover:bg-clinica-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                Editar
                </a>
                </td>
            </tr>
        @endforeach
        </tbody>

    <div class="flex flex-wrap gap-3">
        <a href="{{ route('Pacientes.show') }}"
           class="inline-block bg-clinica-400 hover:bg-clinica-600 text-white font-semibold px-5 py-2 rounded-lg transition">
            Ver detalle de paciente
        </a>

        <a href="{{ route('Pacientes.create') }}"
           class="inline-block bg-clinica-600 hover:bg-clinica-900 text-white font-semibold px-5 py-2 rounded-lg transition">
            Crear nuevo paciente
        </a>
    </div>
</table>  
@endsection