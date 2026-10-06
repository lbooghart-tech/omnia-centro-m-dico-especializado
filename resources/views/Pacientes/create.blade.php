@extends('layouts.app')

@section('content')

<div class="w-full px-4 bg-clinica-50 min-h-screen pb-10">

    <div class="flex flex-wrap items-center justify-between -mx-4 py-3 bg-clinica-900 h-16 px-4">
        <h1 class="text-white text-xl font-bold">Crear nuevo paciente</h1>

        <a href="{{ route('Pacientes.index') }}"
           class="bg-clinica-400 hover:bg-clinica-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            ← Volver
        </a>
    </div>

    <form name="guardar_paciente" id="guardar_paciente"
          style="display: flex; flex-direction: column; width: 300px; margin: auto; background-color: #d7e0e4; padding: 20px;"
          method="POST" action="{{ route('Pacientes.store') }}">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" style="margin-bottom: 10px;">
        @error('nombre')<div style="color: red;">{{ $message }}</div>@enderror

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" style="margin-bottom: 10px;">
        @error('fecha_nacimiento')<div style="color: red;">{{ $message }}</div>@enderror    

        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" style="margin-bottom: 10px;">
            <option value="">Seleccione</option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>
        @error('sexo')<div style="color: red;">{{ $message }}</div>@enderror 


        <label for="tipo_sangre">Tipo de Sangre:</label>
        <select name="tipo_sangre" id="tipo_sangre" style="margin-bottom: 10px;">
            <option value="">Seleccione</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option> 
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select>
        @error('tipo_sangre')<div style="color: red;">{{ $message }}</div>@enderror


        <label for="email">Email:</label>
        <input type="email" name="email" id="email" style="margin-bottom: 10px;">
        @error('email')<div style="color: red;">{{ $message }}</div>@enderror           

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" style="margin-bottom: 10px;">
        @error('telefono')<div style="color: red;">{{ $message }}</div>@enderror

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" style="margin-bottom: 10px;">
        @error('direccion')<div style="color: red;">{{ $message }}</div>@enderror

        <button type="submit" class="bg-clinica-600 hover:bg-clinica-900 text-white font-semibold px-5 py-2 rounded-lg transition">
    Guardar Paciente
</button>
    </form>

</div>

@endsection

