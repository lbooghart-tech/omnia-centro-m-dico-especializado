@extends('layouts.app')

@section('title', 'Pacientes')

@section('content')
    <h2>Pacientes</h2>
    <a href="{{ route('Pacientes.show') }}">Ver detalle de paciente</a>
    <a class="btn btn-primary" href="{{ route('Pacientes.create') }}"><h4>Crear nuevo paciente</h4></a>
@endsection
