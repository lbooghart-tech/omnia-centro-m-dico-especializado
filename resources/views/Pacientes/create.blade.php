@extends('layouts.app')
@section('content')
<div class="w-full px-4 bg-clinica-50">
     <div class="flex flex-wrap -mx-4 py-3 bg-clinica-900 h-16">
        <div class="w-full md:w-5/12 px-4 h-16">
            <h1> Crear nuevo paciente</h1>
        </div>
    </div>
</div>

<div class="w-full px-4 bg-clinica-50 min-h-screen pb-10">
    <div class="flex flex-wrap -mx-4 py-3 bg-clinica-900 h-16 items-center">
        <div class="w-full md:w-5/12 px-4">
            <h1 class="text-white text-xl font-bold">Crear nuevo paciente</h1>
        </div>
    </div>
<form name="guardar_paciente" id="guardar_paciente" 
style="display: flex; flex-direction: column; width: 300px; margin: auto;background-color: #d7e0e4; padding: 20px;"  
method="POST" action="{{ route('Pacientes.store') }}">
@csrf
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" style="margin-bottom: 10px;">
    @error('nombre')<div style="color: red;">{{ $message }}</div>@enderror
    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" id="apellido" style="margin-bottom: 10px;">
    @error('apellido')<div style="color: red;">{{ $message }}</div>@enderror 
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" style="margin-bottom: 10px;">
    @error('telefono')<div style="color: red;">{{ $message }}</div>@enderror
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" style="margin-bottom: 10px;">
    @error('direccion')<div style="color: red;">{{ $message }}</div>@enderror

    <button type="submit" class="btn btn-primary">Guardar Paciente</button>
</form>
@endsection

