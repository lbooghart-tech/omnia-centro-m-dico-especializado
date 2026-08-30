@extends('layouts.app')

@section('title', 'Pacientes')

@section('content')
    <h2 class="text-2xl font-bold text-clinica-900 mb-4">Pacientes</h2>

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
@endsection