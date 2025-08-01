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
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to bottom right, #f0f8ff, #e6f2ff);
            color: #333;
        }
        .navbar {
            background-color: #003366;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: 500;
        }
        .nav-link i {
            margin-right: 5px;
        }
        .hero {
            background-color: #fce4ec;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #333;
            position: relative;
        }
        .hero > .container {
            max-width: 500px;
            background-color: #ffffffcc;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .hero h1 {
            font-size: 2.2rem;
            font-weight: bold;
            color: #d81b60;
        }
        .hero p {
            font-size: 1.1rem;
            color: #555;
        }
        .hero .btn {
            margin-top: 15px;
            background-color: #d81b60;
            color: white;
            border: none;
        }
        .hero .btn:hover {
            background-color: #ad1457;
        }
        .section-title {
            color: #003366;
            font-weight: bold;
        }
        .card-icon {
            font-size: 3rem;
            color: #007bff;
        }
        .testimonial {
            background: linear-gradient(145deg, #e6f2ff, #ffffff);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .testimonial:hover {
            transform: scale(1.05);
        }
        footer {
            background-color: #003366;
            color: white;
            padding: 2rem 0;
            text-align: center;
        }
        .map-container iframe {
            width: 100%;
            height: 300px;
            border: none;
        }
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 15px;
            background: #ffffff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }
        .carousel-inner img {
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-hospital-symbol me-2"></i>Centro Médico</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#servicios"><i class="fas fa-stethoscope"></i>Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonios"><i class="fas fa-users"></i>Testimonios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto"><i class="fas fa-envelope"></i>Contacto</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-light ms-2" href="/login"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero py-4">
        <div class="container text-center" data-sr>
            <h1>Bienvenido al Hospital Central EKO</h1>
            <p>Un lugar donde el cuidado médico y la calidez humana se encuentran para sanar vidas, grandes y pequeñas.</p>
            <a href="/login" class="btn btn-lg">Iniciar Sesión</a>
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

    <!-- Servicios -->
    <div class="container my-5" id="servicios">
        <h2 class="text-center section-title mb-4">Nuestros Servicios</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card p-3">
                    <div class="card-icon mb-2">🩺</div>
                    <h5>Consultas Médicas</h5>
                    <p>Consulta general y especializada con nuestros médicos certificados.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-3">
                    <div class="card-icon mb-2">💊</div>
                    <h5>Farmacia</h5>
                    <p>Medicamentos a precios accesibles con recetas digitales integradas.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-3">
                    <div class="card-icon mb-2">📝</div>
                    <h5>Historial Clínico</h5>
                    <p>Acceso seguro al historial clínico completo de cada paciente.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonios -->
    <div class="container my-5" id="testimonios">
        <h2 class="text-center section-title mb-4">Lo que dicen nuestros pacientes</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="testimonial">
                    <p>"La atención fue excelente y el sistema me permitió agendar mis citas fácilmente."</p>
                    <p><strong>- Ana Martínez</strong></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="testimonial">
                    <p>"Acceder a mi historial clínico y recetas desde casa me ha facilitado mucho la vida."</p>
                    <p><strong>- José Hernández</strong></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contacto -->
    <section class="contact-section py-5 bg-light">
        <div class="container">
            <div class="row">
            <!-- Columna de contacto -->
            <div class="col-md-6 mb-4" data-sr>
                <h2>Contáctanos</h2>
                <p>¿Tienes alguna duda o necesitas una cita? Estamos disponibles para ayudarte.</p>
                <ul class="list-unstyled">
                    <li><strong>Teléfono:</strong> +504 3250-5304</li>
                    <li><strong>Correo:</strong> contacto@hospitalcentral.hn</li>
                    <li><strong>Dirección:</strong> Tegucigalpa, Honduras</li>
                </ul>
            </div>

            <!-- Columna de horarios -->
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
    </section>

    <div class="container">
        <div class="map-container my-5" data-sr>
            <h2 class="text-center mb-3">Nuestra Ubicación</h2>
            <div class="ratio ratio-16x9">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.3283348052975!2d-87.20455868534892!3d14.07227519101442!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f6fdc1417d3a4a7%3A0x6b3e0cb1f7a2b3d4!2sHospital%20Escuela!5e0!3m2!1ses!2shn!4v1627580734213!5m2!1ses!2shn" 
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </div>

    </div>

    


    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Centro Médico Hospitalario. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        ScrollReveal().reveal('.section-title', { 
            delay: 200, 
            origin: 'bottom', 
            distance: '50px', 
            duration: 1000 
        });

        ScrollReveal().reveal('.card', { 
            interval: 200, 
            origin: 'bottom', 
            distance: '30px', 
            duration: 800 
        });

        ScrollReveal().reveal('.testimonial', { 
            interval: 300, 
            origin: 'left', 
            distance: '50px', 
            duration: 1000 
        });

        ScrollReveal().reveal('.hero h1, .hero p, .hero .btn', {
            interval: 300,
            distance: '40px',
            origin: 'top',
            duration: 1200
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
