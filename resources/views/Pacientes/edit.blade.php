@extends('layouts.app')

@section('content')

<div class="w-full px-4 bg-clinica-50 min-h-screen pb-10">

    <div class="flex flex-wrap items-center justify-between -mx-4 py-3 bg-clinica-900 h-16 px-4">
        <h1 class="text-white text-xl font-bold">Editar paciente</h1>

        <a href="{{ route('Pacientes.index') }}"
           class="bg-clinica-400 hover:bg-clinica-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            ← Volver
        </a>
    </div>

    <form name="editar_paciente" id="editar_paciente"
          style="display: flex; flex-direction: column; width: 300px; margin: auto; background-color: #d7e0e4; padding: 20px;"
          method="POST" action="{{ route('Pacientes.update', $paciente->id) }}" novalidate>
        @csrf
        @method('PUT')

        <label for="nombre">Nombre: <span style="color: red;">*</span></label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $paciente->nombre) }}" style="margin-bottom: 10px;">
        @error('nombre')<div style="color: red;">{{ $message }}</div>@enderror

        <label for="dpi">DPI: <span style="color: red;">*</span></label>
        <input type="text" name="dpi" id="dpi" value="{{ old('dpi', $paciente->dpi) }}"
               inputmode="numeric" maxlength="13" style="margin-bottom: 10px;">
        @error('dpi')<div style="color: red;">{{ $message }}</div>@enderror

        <label for="fecha_nacimiento">Fecha de Nacimiento: <span style="color: red;">*</span></label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" style="margin-bottom: 10px;">
        @error('fecha_nacimiento')<div style="color: red;">{{ $message }}</div>@enderror

        <label for="sexo">Sexo: <span style="color: red;">*</span></label>
        <select name="sexo" id="sexo" style="margin-bottom: 10px;">
            <option value="">Seleccione</option>
            <option value="M" {{ old('sexo', $paciente->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
            <option value="F" {{ old('sexo', $paciente->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
        </select>
        @error('sexo')<div style="color: red;">{{ $message }}</div>@enderror

        <label for="tipo_sangre">Tipo de Sangre:</label>
        <select name="tipo_sangre" id="tipo_sangre" style="margin-bottom: 10px;">
            <option value="">Seleccione</option>
            @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $tipo)
                <option value="{{ $tipo }}" {{ old('tipo_sangre', $paciente->tipo_sangre) == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
            @endforeach
        </select>
        @error('tipo_sangre')<div style="color: red;">{{ $message }}</div>@enderror

        <label for="email">Email: <span style="color: red;">*</span></label>
        <input type="email" name="email" id="email" value="{{ old('email', $paciente->email) }}" style="margin-bottom: 10px;">
        @error('email')<div style="color: red;">{{ $message }}</div>@enderror

        <label for="telefono">Teléfono: <span style="color: red;">*</span></label>
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $paciente->telefono) }}" style="margin-bottom: 10px;">
        @error('telefono')<div style="color: red;">{{ $message }}</div>@enderror

        <label for="direccion">Dirección: <span style="color: red;">*</span></label>
        <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $paciente->direccion) }}" style="margin-bottom: 10px;">
        @error('direccion')<div style="color: red;">{{ $message }}</div>@enderror

        <p style="font-size: 12px; margin-bottom: 10px;"><span style="color: red;">*</span> Campo obligatorio</p>

        <button type="submit" class="bg-clinica-600 hover:bg-clinica-900 text-white font-semibold px-5 py-2 rounded-lg transition">
            Guardar cambios
        </button>
    </form>

</div>

@endsection