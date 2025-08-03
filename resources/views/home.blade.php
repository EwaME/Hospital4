<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro Médico Hospitalario</title>
    <script src="https://unpkg.com/scrollreveal"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(130deg, #f4fafe 0%, #e9f1fa 100%);
            color: #20334a;
        }
        .navbar {
            background: linear-gradient(90deg, #00509e 80%, #18b981 100%);
            box-shadow: 0 3px 16px #00509e22;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: 600;
            letter-spacing: .02em;
        }
        .navbar-brand i {
            color: #18b981;
            margin-right: 8px;
            font-size: 1.3em;
        }
        .nav-link.btn {
            padding: 0.45em 1.1em !important;
            border-radius: 2em !important;
            font-size: 1em;
        }
        .hero {
            background: linear-gradient(115deg, #f5fafd 65%, #e6f2ff 100%);
            min-height: 67vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 0;
            margin-bottom: 0;
        }
        .hero-bg-img {
            position: absolute;
            right: 3vw;
            top: 0;
            height: 100%;
            max-width: 54vw;
            opacity: 0.16;
            z-index: 1;
            pointer-events: none;
        }
        .hero > .container {
            z-index: 2;
            background: rgba(255,255,255,0.93);
            border-radius: 22px;
            padding: 2.6rem 2.7rem 2.2rem 2.7rem;
            box-shadow: 0 10px 36px 0 rgba(0, 80, 158, 0.13), 0 2px 12px #00509e13;
            max-width: 530px;
        }
        .hero h1 {
            font-size: 2.3rem;
            font-weight: 800;
            color: #00509e;
            letter-spacing: .01em;
        }
        .hero .lead {
            font-size: 1.19rem;
            color: #34506a;
            font-weight: 500;
        }
        .hero .btn-main {
            margin-top: 25px;
            font-size: 1.17rem;
            font-weight: 600;
            background: linear-gradient(92deg, #14996b 40%, #18B981 100%);
            color: #fff;
            border: none;
            border-radius: 2em;
            box-shadow: 0 2px 12px #00509e18;
            padding: .7em 2.2em;
            transition: background 0.18s, transform .18s, box-shadow .18s;
        }
        .hero .btn-main:hover {
            background: linear-gradient(92deg, #0eab78 30%, #16e59d 100%);
            box-shadow: 0 8px 18px #00509e21;
            transform: scale(1.045);
        }
        .section-title {
            color: #00509e;
            font-weight: 800;
            margin-bottom: 2.2rem;
            letter-spacing: .02em;
        }
        .card-service {
            border: none;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 5px 16px #00509e18;
            transition: transform .22s, box-shadow .22s;
            padding: 2.2em 1.3em 1.2em 1.3em;
            min-height: 295px;
        }
        .card-service:hover {
            transform: translateY(-7px) scale(1.025);
            box-shadow: 0 12px 32px #00509e1c;
        }
        .card-service .card-icon {
            font-size: 2.8rem;
            color: #18b981;
            margin-bottom: .7em;
            text-shadow: 0 2px 14px #18b98123;
        }
        .card-service h5 {
            font-weight: 700;
            color: #00509e;
        }
        .testimonial {
            background: linear-gradient(120deg, #e6f2ff 70%, #f5fafd 100%);
            border-radius: 14px;
            box-shadow: 0 1px 8px #00509e14;
            padding: 1.6em 1.2em 1.2em 1.4em;
            font-size: 1.1em;
            font-style: italic;
            color: #1976d2;
            position: relative;
            margin-bottom: 1.7em;
            min-height: 120px;
        }
        .testimonial strong {
            color: #14996b;
            font-style: normal;
        }
        .testimonial:before {
            content: "\f10d";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: 20px; left: 14px;
            color: #14996b34;
            font-size: 2.3em;
            z-index: 0;
        }
        .carousel-inner img {
            height: 350px;
            object-fit: cover;
            border-radius: 13px;
        }
        .contact-section {
            background: linear-gradient(120deg,#f6fafe 75%, #e6f2ff 100%);
        }
        .contact-section h2 {
            color: #00509e;
            font-weight: 700;
        }
        .contact-section ul li, .contact-section p {
            color: #34506a;
        }
        .list-group-item {
            border: none;
            background: transparent;
        }
        .map-container iframe {
            width: 100%;
            height: 290px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 12px #00509e16;
        }
        footer {
            background: #003366;
            color: white;
            padding: 2rem 0;
            text-align: center;
            letter-spacing: .02em;
            font-weight: 400;
            margin-top: 2.8em;
            box-shadow: 0 -2px 16px #00509e11;
        }
        @media (max-width: 767px) {
            .hero > .container { padding: 1.3rem 0.7rem; }
            .carousel-inner img { height: 180px;}
            .section-title { font-size: 1.4em; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-hospital-symbol"></i>Hospital Central EKO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#servicios"><i class="fas fa-stethoscope"></i>Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonios"><i class="fas fa-users"></i>Testimonios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto"><i class="fas fa-envelope"></i>Contacto</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-light ms-2" href="/login"><i class="fas fa-sign-in-alt"></i>Iniciar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero py-4">
        <img src="{{ asset('images/hospital-fachada.jpg') }}" alt="Hospital" class="hero-bg-img d-none d-lg-block">
        <div class="container text-center" data-sr>
            <h1>Bienvenido al Hospital Central EKO</h1>
            <p class="lead">Cuidando la salud de tu familia con tecnología, humanidad y profesionales certificados.</p>
            <a href="/login" class="btn btn-main shadow">Agendar una cita</a>
        </div>
    </header>

    <div id="carouselServicios" class="carousel slide mt-5 container" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/1.jpg') }}" class="d-block w-100" alt="Investigación">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/5.jpg') }}" class="d-block w-100" alt="Educación">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/3.jpeg') }}" class="d-block w-100" alt="Entrenamiento">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselServicios" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselServicios" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <div class="container my-5" id="servicios">
        <h2 class="text-center section-title mb-4">Nuestros Servicios</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card-service">
                    <div class="card-icon"><i class="fas fa-user-md"></i></div>
                    <h5>Consultas Médicas</h5>
                    <p>Consulta general y especializada con médicos certificados y trato humano.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-service">
                    <div class="card-icon"><i class="fas fa-capsules"></i></div>
                    <h5>Farmacia Integral</h5>
                    <p>Medicamentos a precios accesibles, recetas digitales y entrega rápida en hospital.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-service">
                    <div class="card-icon"><i class="fas fa-notes-medical"></i></div>
                    <h5>Historial Clínico</h5>
                    <p>Acceso seguro a tu historial clínico completo, exámenes y diagnósticos.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5" id="testimonios">
        <h2 class="text-center section-title mb-4">Lo que dicen nuestros pacientes</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="testimonial">
                    "La atención fue excelente y el sistema me permitió agendar mis citas fácilmente."<br>
                    <strong>- Ana Martínez</strong>
                </div>
            </div>
            <div class="col-md-6">
                <div class="testimonial">
                    "Acceder a mi historial clínico y recetas desde casa me ha facilitado mucho la vida."<br>
                    <strong>- José Hernández</strong>
                </div>
            </div>
        </div>
    </div>

    <section class="contact-section py-5" id="contacto">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4" data-sr>
                    <h2>Contáctanos</h2>
                    <p>¿Tienes alguna duda o necesitas una cita? Estamos disponibles para ayudarte.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone"></i> <strong>+504 3250-5304</strong></li>
                        <li><i class="fas fa-envelope"></i> <strong>contacto@hospitalcentral.hn</strong></li>
                        <li><i class="fas fa-map-marker-alt"></i> <strong>Tegucigalpa, Honduras</strong></li>
                    </ul>
                </div>
                <div class="col-md-6" data-sr>
                    <h2>Horario de Atención</h2>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Lunes a Viernes</span><span>7:30am - 5:00pm</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Sábados</span><span>8:00am - 1:00pm</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Emergencias</span><span>24/7</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="map-container my-5" data-sr>
            <h2 class="text-center mb-3">Nuestra Ubicación</h2>
            <div class="ratio ratio-16x9">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.3283348052975!2d-87.20455868534892!3d14.07227519101442!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f6fdc1417d3a4a7%3A0x6b3e0cb1f7a2b3d4!2sHospital%20Escuela!5e0!3m2!1ses!2shn!4v1627580734213!5m2!1ses!2shn" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Centro Médico Hospitalario. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        ScrollReveal().reveal('.section-title', { delay: 200, origin: 'bottom', distance: '50px', duration: 1000 });
        ScrollReveal().reveal('.card-service', { interval: 200, origin: 'bottom', distance: '30px', duration: 900 });
        ScrollReveal().reveal('.testimonial', { interval: 300, origin: 'left', distance: '50px', duration: 900 });
        ScrollReveal().reveal('.hero h1, .hero .lead, .hero .btn-main', {
            interval: 200, distance: '40px', origin: 'top', duration: 1200
        });
        ScrollReveal().reveal('[data-sr]', {
            duration: 1000,
            distance: '50px',
            origin: 'bottom',
            easing: 'ease-in-out',
            reset: false
        });
    </script>
</body>
</html>
