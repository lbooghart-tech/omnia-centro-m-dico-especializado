@extends('layouts.app')

@section('title', 'Detalle de paciente')

@section('content')
    <h2>Esto es show.blade.php</h2>
    <a href="{{ route('Pacientes.index') }}">&larr; Volver a Pacientes</a>
@endsection