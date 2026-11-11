
@extends('layouts.app')
@section('content')
<div class="w-full px-4 bg-clinica-50 min-h-screen pb-10">
    <div class="flex flex-wrap items-center justify-between -mx-4 py-3 bg-clinica-900 h-16 px-4">
        <h1 class="text-white text-xl font-bold">Crear nuevo doctor</h1>
        <a href="{{ route('Doctores.index') }}"
           class="bg-clinica-400 hover:bg-clinica-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            ← Volver
        </a>
    </div>
    <form name="guardar_doctor" id="guardar_doctor"
          style="display: flex; flex-direction: column; width: 300px; margin: auto; background-color: #d7e0e4; padding: 20px;"
          method="POST" action="{{ route('Doctores.store') }}" novalidate>
        @csrf
        <label for="nombre">Nombre: <span style="color: red;">*</span></label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" style="margin-bottom: 10px;">
        @error('nombre')<div style="color: red;">{{ $message }}</div>@enderror
        <label for="especialidad">Especialidad: <span style="color: red;">*</span></label>
        <input type="text" name="especialidad" id="especialidad" value="{{ old('especialidad') }}" style="margin-bottom: 10px;">
        @error('especialidad')<div style="color: red;">{{ $message }}</div>@enderror
        <label for="horario">Horario: <span style="color: red;">*</span></label>
        <select name="horario" id="horario" style="margin-bottom: 10px;">
            <option value="">Seleccione</option>
            <option value="AM" {{ old('horario') == 'AM' ? 'selected' : '' }}>AM</option>
            <option value="PM" {{ old('horario') == 'PM' ? 'selected' : '' }}>PM</option>
        </select>
        @error('horario')<div style="color: red;">{{ $message }}</div>@enderror
        <label for="colegiado">Colegiado: <span style="color: red;">*</span></label>
        <input type="text" name="colegiado" id="colegiado" value="{{ old('colegiado') }}" style="margin-bottom: 10px;">
        @error('colegiado')<div style="color: red;">{{ $message }}</div>@enderror
        <label for="telefono">Teléfono: <span style="color: red;">*</span></label>
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}" style="margin-bottom: 10px;">
        @error('telefono')<div style="color: red;">{{ $message }}</div>@enderror
        <p style="font-size: 12px; margin-bottom: 10px;"><span style="color: red;">*</span> Campo obligatorio</p>
        <button type="submit" class="bg-clinica-600 hover:bg-clinica-900 text-white font-semibold px-5 py-2 rounded-lg transition">
            Guardar Doctor
        </button>
    </form>
</div>
@endsection
