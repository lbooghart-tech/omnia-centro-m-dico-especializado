@extends('layouts.app')

@section('content')

<div class="w-full px-4 bg-clinica-50 min-h-screen pb-10">

    <div class="flex flex-wrap items-center justify-between -mx-4 py-3 bg-clinica-900 h-16 px-4">
        <h1 class="text-white text-xl font-bold">Agendar cita</h1>

        <a href="{{ route('Citas.index') }}"
           class="bg-clinica-400 hover:bg-clinica-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            ← Volver
        </a>
    </div>

    <form name="guardar_cita" id="guardar_cita"
          style="display: flex; flex-direction: column; width: 320px; margin: auto; background-color: #d7e0e4; padding: 20px;"
          method="POST" action="{{ route('Citas.store') }}" novalidate>
        @csrf

        <label for="dpi">DPI del paciente: <span style="color: red;">*</span></label>
        <input type="text" name="dpi" id="dpi" value="{{ old('dpi') }}"
               inputmode="numeric" maxlength="13" style="margin-bottom: 4px;">
        <div id="dpi_msg" style="color: red; margin-bottom: 6px;"></div>
        @error('dpi')<div style="color: red; margin-bottom: 6px;">{{ $message }}</div>@enderror

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" readonly style="margin-bottom: 10px; background-color: #eef2f4;">

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" readonly style="margin-bottom: 10px; background-color: #eef2f4;">

        <label for="doctor_id">Doctor: <span style="color: red;">*</span></label>
        <select name="doctor_id" id="doctor_id" style="margin-bottom: 10px;">
            <option value="">Seleccione</option>
            @foreach ($doctores as $doctor)
                <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                    {{ $doctor->nombre }} — {{ $doctor->especialidad }} ({{ $doctor->horario }})
                </option>
            @endforeach
        </select>
        @error('doctor_id')<div style="color: red;">{{ $message }}</div>@enderror

        <label for="fecha">Fecha: <span style="color: red;">*</span></label>
        <select name="fecha" id="fecha" disabled style="margin-bottom: 10px;">
            <option value="">Seleccione un doctor primero</option>
        </select>
        @error('fecha')<div style="color: red;">{{ $message }}</div>@enderror

        <label for="hora">Hora: <span style="color: red;">*</span></label>
        <select name="hora" id="hora" disabled style="margin-bottom: 10px;">
            <option value="">Seleccione una fecha primero</option>
        </select>
        @error('hora')<div style="color: red;">{{ $message }}</div>@enderror

        <p style="font-size: 12px; margin-bottom: 10px;"><span style="color: red;">*</span> Campo obligatorio</p>

        <button type="submit" class="bg-clinica-600 hover:bg-clinica-900 text-white font-semibold px-5 py-2 rounded-lg transition">
            Agendar cita
        </button>
    </form>

</div>

<script>
    const dpiInput = document.getElementById('dpi');
    const dpiMsg   = document.getElementById('dpi_msg');
    const nombre   = document.getElementById('nombre');
    const telefono = document.getElementById('telefono');
    const doctor   = document.getElementById('doctor_id');
    const fecha    = document.getElementById('fecha');
    const hora     = document.getElementById('hora');

    const OLD = { fecha: @json(old('fecha')), hora: @json(old('hora')) };
    const URL_PACIENTE = @json(url('/citas/paciente'));
    const URL_DISPONIBILIDAD = @json(route('Citas.disponibilidad'));

    let disponibilidad = {};

    function etiquetaFecha(f) {
        const d = new Date(f + 'T00:00:00');
        return d.toLocaleDateString('es-GT', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });
    }

    function formato12(h) {
        const [hh, mm] = h.split(':');
        const n = parseInt(hh, 10);
        return (n % 12 === 0 ? 12 : n % 12) + ':' + mm + ' ' + (n >= 12 ? 'PM' : 'AM');
    }

    function etiquetaHora(h) {
        const [hh, mm] = h.split(':');
        const fin = String(parseInt(hh, 10) + 1).padStart(2, '0') + ':' + mm;
        return formato12(h) + ' - ' + formato12(fin);
    }

    function llenarFechas(fechaSel) {
        const fechas = Object.keys(disponibilidad);
        if (fechas.length === 0) {
            fecha.innerHTML = '<option value="">No hay fechas disponibles</option>';
            fecha.disabled = true;
            return;
        }
        fecha.innerHTML = '<option value="">Seleccione</option>';
        fechas.forEach(f => {
            const o = document.createElement('option');
            o.value = f;
            o.textContent = etiquetaFecha(f);
            fecha.appendChild(o);
        });
        fecha.disabled = false;
        if (fechaSel && disponibilidad[fechaSel]) fecha.value = fechaSel;
    }

    function llenarHoras(horaSel) {
        if (!fecha.value) {
            hora.innerHTML = '<option value="">Seleccione una fecha primero</option>';
            hora.disabled = true;
            return;
        }
        hora.innerHTML = '<option value="">Seleccione</option>';
        (disponibilidad[fecha.value] || []).forEach(h => {
            const o = document.createElement('option');
            o.value = h;
            o.textContent = etiquetaHora(h);
            hora.appendChild(o);
        });
        hora.disabled = false;
        if (horaSel) hora.value = horaSel;
    }

    async function cargarDisponibilidad(fechaSel = '', horaSel = '') {
        disponibilidad = {};
        if (!doctor.value) {
            fecha.innerHTML = '<option value="">Seleccione un doctor primero</option>';
            fecha.disabled = true;
            llenarHoras('');
            return;
        }
        const params = new URLSearchParams({ doctor_id: doctor.value });
        if (/^\d{13}$/.test(dpiInput.value.trim())) params.set('dpi', dpiInput.value.trim());

        const r = await fetch(URL_DISPONIBILIDAD + '?' + params, { headers: { 'Accept': 'application/json' } });
        disponibilidad = await r.json();
        llenarFechas(fechaSel);
        llenarHoras(horaSel);
    }

    function limpiarPaciente() {
        nombre.value = '';
        telefono.value = '';
        dpiMsg.textContent = '';
    }

    async function buscarPaciente(dpi, recargar = true) {
        const r = await fetch(URL_PACIENTE + '/' + dpi, { headers: { 'Accept': 'application/json' } });
        if (!r.ok) {
            dpiMsg.textContent = 'No existe un paciente registrado con ese DPI.';
            return;
        }
        const p = await r.json();
        nombre.value = p.nombre;
        telefono.value = p.telefono;
        if (recargar && doctor.value) await cargarDisponibilidad(fecha.value, hora.value);
    }

    dpiInput.addEventListener('input', () => {
        const v = dpiInput.value.trim();
        limpiarPaciente();
        if (/\D/.test(v)) {
            dpiMsg.textContent = 'El DPI debe ser un número entero, sin espacios ni guiones.';
            return;
        }
        if (v.length === 13) buscarPaciente(v);
    });

    doctor.addEventListener('change', () => cargarDisponibilidad('', ''));
    fecha.addEventListener('change', () => llenarHoras(''));

    // Al volver con errores de validación, restaura lo que el usuario había elegido
    (async () => {
        const v = dpiInput.value.trim();
        if (/^\d{13}$/.test(v)) await buscarPaciente(v, false);
        if (doctor.value) await cargarDisponibilidad(OLD.fecha, OLD.hora);
    })();
</script>

@endsection