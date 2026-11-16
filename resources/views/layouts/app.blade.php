{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'OmniaCentroMedico')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              clinica: {
                50: '#F5F7F8',
                200: '#D7E0E4',
                400: '#7FBAC6',
                600: '#2E7E95',
                900: '#1B3A44',
              }
            }
          }
        }
      }
    </script>
</head>
<body>
    <header>
        {{-- menu --}}
        <nav class="bg-clinica-600 text-white p-4">
            <div class="container mx-auto">
                <ul class="flex items-center space-x-4">
                    <li>
                        <a href="{{ url('/') }}" class="navbar-brand flex items-center gap-2">
                            <img src="{{ asset('favicon.png') }}" alt="Omnia Centro Médico" class="h-10 w-auto">
                        </a>
                    </li>
                   <li><a href="{{ route('Pacientes.index') }}" class="hover:text-clinica-200">Pacientes</a></li>
                    <li><a href="{{ route('Doctores.index') }}" class="hover:text-clinica-200">Doctores</a></li>
                    <li><a href="{{ route('Citas.index') }}" class="hover:text-clinica-200">Citas</a></li>
                    
                </ul>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>OmniaCentroMedico &copy; {{ date('Y') }}</p>
    </footer>
</body>
</html>