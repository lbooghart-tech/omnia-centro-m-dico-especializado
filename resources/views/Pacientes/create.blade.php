@extends('layouts.app')
@section('content')
    <h1>Crear nuevo paciente</h1>

<form name="guardar_paciente" id="guardar_paciente" 
style="width: 50%; margin: auto;" method="POST" background-color: #d7e0e4; padding: 20px; border-radius: 5px; 
method="POST" action="{{ route('Pacientes.store') }}">
@csrf
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" style="margin-bottom: 10px;">
    @error('nombre')<div class="alert alert-danger">{{ $message }}</div>@enderror
    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" id="apellido" style="margin-bottom: 10px;">
    @error('apellido')<div class="alert alert-danger">{{ $message }}</div>@enderror 
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" style="margin-bottom: 10px;">
    @error('telefono')<div class="alert alert-danger">{{ $message }}</div>@enderror
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" style="margin-bottom: 10px;">
    @error('direccion')<div class="alert alert-danger">{{ $message }}</div>@enderror

    <button type="submit" class="btn btn-primary">Guardar Paciente</button>
</form>
@endsection