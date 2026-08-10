<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'OmniCentroMedico')</title>
</head>
<body>
    <header>
        <h1>OmniCentroMedico</h1>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>OmniCentroMedico &copy; {{ date('Y') }}</p>
    </footer>
</body>
</html>