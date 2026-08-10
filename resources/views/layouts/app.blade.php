<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'OmniaCentroMedico')</title>
</head>
<body>
    <header>
        <h1>Omnia Centro Medico</h1>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>OmniaCentroMedico &copy; {{ date('Y') }}</p>
    </footer>
</body>
</html>