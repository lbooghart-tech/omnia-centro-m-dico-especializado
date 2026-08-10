@extends('layouts.app')

@section('title', 'Pacientes')

@section('content')
    <h2>Pacientes</h2>
    <a href="{{ route('Pacientes.show') }}">Ver detalle de paciente</a>
@endsection
