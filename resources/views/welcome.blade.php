{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('content')

    {{-- Carrusel de imágenes (Tailwind + JS simple) --}}
    <div x-data="{}" id="carrusel" class="relative w-full max-w-5xl mx-auto mt-6 overflow-hidden rounded-xl shadow-lg" data-autoplay-interval="4000">

        {{-- Slides --}}
        <div id="carrusel-track" class="flex transition-transform duration-700 ease-in-out">

            <div class="min-w-full relative">
                <img src="{{ asset('images/carrusel-1.jpg') }}" alt="Servicios" class="w-full h-80 object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-clinica-900/60 text-white p-4">
                    <h5 class="font-semibold text-lg">Conoce nuestros servicios</h5>
                    <p class="text-sm">Omnia Centro Médico ofrece una amplia gama de servicios médicos de calidad.</p>
                </div>
            </div>

            <div class="min-w-full relative">
                <img src="{{ asset('images/carrusel-2.jpg') }}" alt="Infraestructura" class="w-full h-80 object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-clinica-900/60 text-white p-4">
                    <h5 class="font-semibold text-lg">Descubre nuestra infraestructura</h5>
                    <p class="text-sm">Diseñada para brindar el mejor cuidado médico.</p>
                </div>
            </div>

            <div class="min-w-full relative">
                <img src="{{ asset('images/carrusel-3.jpg') }}" alt="Equipo" class="w-full h-80 object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-clinica-900/60 text-white p-4">
                    <h5 class="font-semibold text-lg">Nuestro equipo de profesionales</h5>
                    <p class="text-sm">Personal altamente capacitado para brindar el mejor servicio médico.</p>
                </div>
            </div>

        </div>

        {{-- Flecha izquierda --}}
        <button id="carrusel-prev" type="button"
            class="absolute top-1/2 left-3 -translate-y-1/2 bg-clinica-900/50 hover:bg-clinica-900/80 text-white w-9 h-9 rounded-full flex items-center justify-center">
            ‹
        </button>

        {{-- Flecha derecha --}}
        <button id="carrusel-next" type="button"
            class="absolute top-1/2 right-3 -translate-y-1/2 bg-clinica-900/50 hover:bg-clinica-900/80 text-white w-9 h-9 rounded-full flex items-center justify-center">
            ›
        </button>

        {{-- Indicadores --}}
        <div id="carrusel-dots" class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-2">
            <button data-slide="0" class="w-2.5 h-2.5 rounded-full bg-white/70"></button>
            <button data-slide="1" class="w-2.5 h-2.5 rounded-full bg-white/40"></button>
            <button data-slide="2" class="w-2.5 h-2.5 rounded-full bg-white/40"></button>
        </div>
    </div>

    <script>
        (function () {
            const track = document.getElementById('carrusel-track');
            const dots = document.querySelectorAll('#carrusel-dots button');
            const total = dots.length;
            let current = 0;
            let timer;

            function goTo(index) {
                current = (index + total) % total;
                track.style.transform = `translateX(-${current * 100}%)`;
                dots.forEach((dot, i) => {
                    dot.classList.toggle('bg-white/70', i === current);
                    dot.classList.toggle('bg-white/40', i !== current);
                });
            }

            function next() { goTo(current + 1); }
            function prev() { goTo(current - 1); }

            document.getElementById('carrusel-next').addEventListener('click', () => { next(); resetTimer(); });
            document.getElementById('carrusel-prev').addEventListener('click', () => { prev(); resetTimer(); });
            dots.forEach((dot, i) => dot.addEventListener('click', () => { goTo(i); resetTimer(); }));

            function resetTimer() {
                clearInterval(timer);
                timer = setInterval(next, 6000);
            }

            resetTimer();
        })();
    </script>

@endsection