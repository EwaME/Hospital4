<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Hospital EKO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-neutral-900 text-neutral-800 dark:text-white flex">

    {{-- Sidebar --}}
    <aside class="w-64 min-h-screen bg-white dark:bg-neutral-800 shadow-lg p-6 hidden md:block">
        <h2 class="text-2xl font-bold text-blue-700 dark:text-blue-400 mb-6">🏥 Hospital EKO</h2>

        <p class="mb-4 font-semibold">👤 {{ Auth::user()->name }}</p>

        <ul class="space-y-2 font-semibold">
            <li><a href="/" class="block hover:text-blue-500">Inicio</a></li>
            <li><a href="/roles" class="block hover:text-blue-500">Roles</a></li>
            <li><a href="/pacientes" class="block hover:text-blue-500">Pacientes</a></li>
            <li><a href="/doctores" class="block hover:text-blue-500">Doctores</a></li>
            <li><a href="/usuarios" class="block hover:text-blue-500">Usuarios</a></li>
            <li><a href="/medicamentos" class="block hover:text-blue-500">Medicamentos</a></li>
            <li><a href="/enfermedades" class="block hover:text-blue-500">Enfermedades</a></li>
            <li><a href="/citas" class="block hover:text-blue-500">Citas</a></li>
            <li><a href="/consultas" class="block hover:text-blue-500">Consultas</a></li>
            <li><a href="/historialClinico" class="block hover:text-blue-500">Historial Clínico</a></li>
            <li><a href="/bitacoras" class="block hover:text-blue-500">Bitácoras</a></li>
        </ul>

        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="w-full text-left text-red-500 hover:underline">🚪 Cerrar sesión</button>
        </form>
    </aside>

    {{-- Contenido principal --}}
    <div class="flex-1">

        {{-- Navbar superior --}}
        <nav class="bg-white dark:bg-neutral-800 shadow md:hidden">
            <div class="px-4 py-4 flex justify-between items-center">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-blue-700 dark:text-blue-400">
                    🏥 Hospital EKO
                </a>
                <button id="menu-btn" class="text-blue-700 dark:text-blue-400 focus:outline-none">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                    </svg>
                </button>
            </div>
            <div id="menu" class="hidden px-4 pb-4">
                <ul class="flex flex-col gap-2 font-semibold text-neutral-700 dark:text-neutral-300">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/roles">Roles</a></li>
                    <li><a href="/pacientes">Pacientes</a></li>
                    <li><a href="/doctores">Doctores</a></li>
                    <li><a href="/usuarios">Usuarios</a></li>
                    <li><a href="/medicamentos">Medicamentos</a></li>
                    <li><a href="/enfermedades">Enfermedades</a></li>
                    <li><a href="/citas">Citas</a></li>
                    <li><a href="/consultas">Consultas</a></li>
                    <li><a href="/historialClinico">Historial Clínico</a></li>
                    <li><a href="/bitacoras">Bitácoras</a></li>
                </ul>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline">🚪 Cerrar sesión</button>
                </form>
            </div>
        </nav>

        <main class="p-6">
            <h1 class="text-4xl text-center font-extrabold mb-10 text-blue-700 dark:text-blue-300">
                🏥 Bienvenido al Panel Principal del Hospital EKO
            </h1>

            @php
                $modulos = [
                    ['permiso' => 'Ver Bitacoras', 'titulo' => 'Bitácoras', 'emoji' => '📘', 'color' => 'bg-blue-100 dark:bg-blue-900'],
                    ['permiso' => 'Ver Citas', 'titulo' => 'Citas', 'emoji' => '📅', 'color' => 'bg-yellow-100 dark:bg-yellow-900'],
                    ['permiso' => 'Ver Consultas', 'titulo' => 'Consultas', 'emoji' => '🩺', 'color' => 'bg-green-100 dark:bg-green-900'],
                    ['permiso' => 'Ver Doctores', 'titulo' => 'Doctores', 'emoji' => '👨‍⚕️', 'color' => 'bg-purple-100 dark:bg-purple-900'],
                    ['permiso' => 'Ver Historiales', 'titulo' => 'Historiales', 'emoji' => '📄', 'color' => 'bg-indigo-100 dark:bg-indigo-900'],
                    ['permiso' => 'Ver Pacientes', 'titulo' => 'Pacientes', 'emoji' => '🧑‍🤝‍🧑', 'color' => 'bg-pink-100 dark:bg-pink-900'],
                    ['permiso' => 'Ver Roles', 'titulo' => 'Roles', 'emoji' => '🛡️', 'color' => 'bg-red-100 dark:bg-red-900'],
                    ['permiso' => 'Ver Usuarios', 'titulo' => 'Usuarios', 'emoji' => '👥', 'color' => 'bg-teal-100 dark:bg-teal-900'],
                    ['permiso' => 'Ver Enfermedades', 'titulo' => 'Enfermedades', 'emoji' => '🦠', 'color' => 'bg-orange-100 dark:bg-orange-900'],
                    ['permiso' => 'Ver Medicamentos', 'titulo' => 'Medicamentos', 'emoji' => '💊', 'color' => 'bg-fuchsia-100 dark:bg-fuchsia-900'],
                    ['permiso' => 'Ver ConsultaMedicamentos', 'titulo' => 'Consulta Medicamentos', 'emoji' => '📋', 'color' => 'bg-cyan-100 dark:bg-cyan-900'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($modulos as $modulo)
                    @can($modulo['permiso'])
                        <div class="rounded-2xl {{ $modulo['color'] }} p-6 shadow-xl hover:scale-105 transition-all duration-300 ease-in-out cursor-pointer">
                            <div class="flex flex-col items-center justify-center gap-4 text-center">
                                <div class="text-7xl">{{ $modulo['emoji'] }}</div>
                                <div class="text-2xl font-bold">{{ $modulo['titulo'] }}</div>
                            </div>
                        </div>
                    @endcan
                @endforeach
            </div>

            <p class="mt-10 text-center text-sm text-neutral-500 dark:text-neutral-400">
                Sistema de Gestión Hospitalaria – Hospital EKO 🧬
            </p>
        </main>
    </div>

    {{-- Script menú móvil --}}
    <script>
        document.getElementById('menu-btn').addEventListener('click', () => {
            document.getElementById('menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
