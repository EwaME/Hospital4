<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bienvenido a Hospital EKO</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet" />

    <style>
        body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #cbd5e1, #a5b4fc, #93c5fd);
        background-size: 600% 600%;
        animation: gradientShift 18s ease infinite;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        overflow: hidden;
        position: relative;
        }

        @keyframes gradientShift {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
        }
        .fade-in {
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-glow {
            transition: all 0.3s ease;
        }

        .btn-glow:hover {
            box-shadow: 0 0 12px rgba(13, 148, 136, 0.5);
            transform: translateY(-2px);
        }

        a.link-sugerido {
            transition: color 0.3s ease;
        }

        a.link-sugerido:hover {
            color: #0d9488;
        }

        .sparkle {
        position: absolute;
        border-radius: 50%;
        background: white;
        opacity: 0.7;
        animation: sparklePulse 3s ease-in-out infinite;
        filter: drop-shadow(0 0 6px white);
        pointer-events: none;
        }

        @keyframes sparklePulse {
        0%, 100% {opacity: 0.8; transform: scale(1);}
        50% {opacity: 0.3; transform: scale(1.4);}
        }

        .sparkle:nth-child(1) { top: 10%; left: 12%; width: 9px; height: 9px; animation-delay: 0s;}
        .sparkle:nth-child(2) { top: 30%; left: 85%; width: 6px; height: 6px; animation-delay: 1s;}
        .sparkle:nth-child(3) { top: 75%; left: 22%; width: 7px; height: 7px; animation-delay: 2s;}
        .sparkle:nth-child(4) { top: 85%; left: 80%; width: 11px; height: 11px; animation-delay: 1.5s;}
        .sparkle:nth-child(5) { top: 50%; left: 50%; width: 5px; height: 5px; animation-delay: 0.7s;}

        .fade-in {
        animation: fadeInUp 1s ease forwards;
        opacity: 0;
        transform: translateY(20px);
        }

        @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
        }

        .container-glass {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 2rem;
        box-shadow: 0 6px 40px rgba(0, 0, 0, 0.1), inset 0 0 60px rgba(255, 255, 255, 0.25);
        padding: 3rem 4rem;
        max-width: 48rem;
        width: 100%;
        text-align: center;
        color: #f8fafc;
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        z-index: 10;
        }

        h1 {
        animation: bounce-slow 5s ease-in-out infinite;
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        @keyframes bounce-slow {
        0%, 100% { transform: translateY(0);}
        50% { transform: translateY(-10px);}
        }

        /* Botones */
        .btn-primary, .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-weight: 700;
        padding: 1.5rem 3rem;
        border-radius: 1.5rem;
        box-shadow: inset 0 -4px 8px rgba(0,0,0,0.15);
        transition: background 0.4s ease, box-shadow 0.3s ease, transform 0.25s ease;
        user-select: none;
        text-decoration: none;
        font-size: 1.125rem; /* 18px */
        cursor: pointer;
        border: none;
        color: white;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        box-shadow: inset 0 -4px 8px rgba(37, 99, 235, 0.7), 0 6px 20px rgba(37, 99, 235, 0.6);
        }
        .btn-primary:hover, .btn-primary:focus-visible {
        background: linear-gradient(135deg, #1e40af, #1e3a8a);
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.9), inset 0 -6px 12px rgba(59, 130, 246, 0.9);
        transform: translateY(-3px) scale(1.05);
        outline: none;
        }

        .btn-secondary {
        background: linear-gradient(135deg, #10b981, #059669);
        box-shadow: inset 0 -4px 8px rgba(5, 150, 105, 0.7), 0 6px 20px rgba(5, 150, 105, 0.5);
        }
        .btn-secondary:hover, .btn-secondary:focus-visible {
        background: linear-gradient(135deg, #047857, #065f46);
        box-shadow: 0 0 20px rgba(16, 185, 129, 0.9), inset 0 -6px 12px rgba(16, 185, 129, 0.9);
        transform: translateY(-3px) scale(1.05);
        outline: none;
        }

        /* Íconos en botones */
        .btn-icon {
        font-size: 1.3rem;
        line-height: 0;
        }

        /* Links externos */
        nav a {
        color: #dbeafe;
        text-decoration: none;
        font-weight: 600;
        padding: 0.3rem 0.5rem;
        border-radius: 0.375rem;
        transition: color 0.3s ease, background-color 0.3s ease;
        box-shadow: 0 1px 4px rgba(0,0,0,0.12);
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        user-select: text;
        }

        nav a:hover, nav a:focus-visible {
        color: #93c5fd;
        background-color: rgba(255 255 255 / 0.15);
        outline: none;
        text-decoration: underline;
        box-shadow: 0 4px 20px rgba(147, 197, 253, 0.6);
        }

        /* Responsive */
        @media (max-width: 640px) {
        .container-glass {
            padding: 2rem 2.5rem;
        }
        h1 {
            font-size: 2.75rem;
        }
        .btn-primary, .btn-secondary {
            padding: 1.2rem 2.5rem;
            font-size: 1rem;
        }
        nav a {
            font-size: 0.875rem;
        }
        }
    </style>
    </head>
    <body>

    <!-- Sparkles -->
    <span class="sparkle"></span>
    <span class="sparkle"></span>
    <span class="sparkle"></span>
    <span class="sparkle"></span>
    <span class="sparkle"></span>

    <div class="container-glass fade-in" role="main" aria-label="Bienvenida al sistema Hospital EKO">

        {{-- Logo y título --}}
        <div class="mb-8">
            <div class="inline-flex items-center justify-center text-6xl mb-4 animate-pulse">🏥</div>
            <h1 class="text-5xl font-extrabold text-teal-700 mb-3 drop-shadow-lg">
                ¡Bienvenido a <span class="text-cyan-600">Hospital EKO</span>!
            </h1>
            <p class="text-lg text-gray-700 max-w-xl mx-auto leading-relaxed">
                Tu sistema de gestión hospitalaria confiable, seguro y fácil de usar.
                <br />
                Estamos felices de tenerte aquí para comenzar esta aventura juntos.
            </p>
        </div>

        {{-- Botones --}}
        <div class="mt-10 flex flex-col sm:flex-row justify-center gap-10" role="navigation" aria-label="Acciones principales">
        @if (Route::has('login'))
            @auth
            <a href="{{ url('/home') }}" class="btn-primary" tabindex="0">
                <span class="btn-icon" aria-hidden="true">🏠</span> Ir al Panel
            </a>
            @else
            <a href="{{ route('login') }}" class="btn-primary" tabindex="0">
                <span class="btn-icon" aria-hidden="true">🔐</span> Iniciar Sesión
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-secondary" tabindex="0">
                <span class="btn-icon" aria-hidden="true">📝</span> Crear Cuenta
                </a>
            @endif
            @endauth
        @endif
        </div>

        {{-- Enlaces externos --}}
        <nav class="mt-12 flex justify-center gap-10 flex-wrap text-sm text-indigo-200" aria-label="Enlaces externos de Laravel">
        <a href="https://docs.google.com/document/d/1YSUjjVkKSxcmjw69D_-2UC40uZFFRFD_jJyARNMfGzw/edit?usp=sharing" target="_blank" rel="noopener" tabindex="0">
            📘 Documentación
        </a>
        <a href="https://github.com/EwaME/Hospital4" target="_blank" rel="noopener" tabindex="0">
            💾 Repositorio
        </a>
        </nav>

        {{-- Footer --}}
        <footer class="mt-14 text-indigo-100 text-xs" aria-label="Versión de software">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} &nbsp;&bull;&nbsp; PHP v{{ PHP_VERSION }}
        </footer>
    </div>

    </body>
    </html>

