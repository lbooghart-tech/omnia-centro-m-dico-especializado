<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <title>Omnia Centro Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- menu -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <li><a href="{{ url('/') }}" class="navbar-brand">
    <img src="{{ asset('favicon.png') }}" alt="Omnia Centro Médico" height="40">
</a></li>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <li class="nav-item"><a class="nav-link" href="{{ route('Pacientes.index') }}">Pacientes</a></li>
        </li>
      </form>
    </div>
  </div>
</nav>
    <div class="container mt-4">
        @yield('content')
    </div>
  <!-----------carrusel---------------->
  <div id="carouselExampleDark" class="carousel carousel-dark slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="{{ asset('images/carrusel-1.jpg') }}" class="d-block w-100" alt="1" height="300" right="50">
      <div class="carousel-caption d-none d-md-block">
        <h5>Conoce nuestros servicios</h5>
        <p>Omnia Centro Médico ofrece una amplia gama de servicios médicos de calidad.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="{{ asset('images/carrusel-2.jpg') }}" class="d-block w-100" alt="2" height="300" right="50">
      <div class="carousel-caption d-none d-md-block">
        <h5>Descubre nuestra infraestructura</h5>
        <p>Descubre la moderna infraestructura de Omnia Centro Médico, diseñada para brindar el mejor cuidado médico.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/carrusel-3.jpg') }}" class="d-block w-100" alt="3" height="300" right="50">
      <div class="carousel-caption d-none d-md-block">
        <h5>Nuestra equipo de profesionales</h5>
        <p>Contamos con un equipo de profesionales altamente capacitados para brindar el mejor servicio médico.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
      


    <footer class="text-center mt-4">
        OmniaCentroMedico &copy; {{ date('Y') }}
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>