<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Historial Clínico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #e9f3ff 0%, #d5f3ea 100%);
            min-height: 100vh;
        }
        .main-content {
            margin-left: 260px;
            transition: margin-left 0.25s;
        }
        .main-collapsed {
            margin-left: 70px !important;
        }
        @media (max-width: 991.98px) {
            .main-content { margin-left: 0; }
        }
        .glass-bg {
            background: linear-gradient(135deg, rgba(248,252,255,0.97) 0%, rgba(48,107,165,0.09) 100%);
            border-radius: 1.4rem;
            border: 1.5px solid #b5d5fa;
            box-shadow: 0 10px 36px 0 rgba(0, 80, 158, 0.13), 0 2px 12px #00509e13;
            backdrop-filter: blur(18px);
            padding: 2.7rem 2.1rem 2rem 2.1rem;
            margin-top: 3.7rem;
            animation: fade-in-up 0.8s cubic-bezier(.4,2,.6,1) both;
            max-width: 540px;
            margin-left: auto;
            margin-right: auto;
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(60px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .historial-header {
            font-size: 2.1rem;
            font-weight: 900;
            color: #00509e;
            text-shadow: 0 2px 16px #00509e23;
            letter-spacing: 0.01em;
            margin-bottom: 2.1rem;
            text-align: center;
            display: flex;
            gap: .6em;
            justify-content: center;
            align-items: center;
        }
        .historial-header .fa-notes-medical {
            color: #18B981;
            font-size: 1.25em;
            filter: drop-shadow(0 2px 9px #00509e21);
        }
        .form-label {
            font-weight: 600;
            color: #1976d2;
            margin-bottom: .5em;
        }
        .form-control[readonly], .form-control-plaintext {
            background: transparent !important;
            color: #395674 !important;
            font-weight: 500;
        }
        .border, .bg-light {
            border-radius: 1rem !important;
        }
        .btn-glass {
            background: linear-gradient(92deg, #14996b 40%, #18B981 100%);
            color: #fff !important;
            font-weight: 600;
            border: none;
            border-radius: 0.9em;
            box-shadow: 0 2px 12px #00509e18;
            transition: background 0.2s, transform 0.17s, box-shadow 0.2s;
        }
        .btn-glass:hover, .btn-glass:focus {
            background: linear-gradient(92deg, #0eab78 30%, #16e59d 100%);
            box-shadow: 0 8px 18px #00509e2c;
            transform: scale(1.05);
        }
        @media (max-width: 575px) {
            .glass-bg { padding: 0.8rem 0.05rem; }
            .historial-header { font-size: 1.12rem;}
            .btn-glass { font-size: 1em; padding: 0.37em 0.71em;}
        }
    </style>
</head>
<body>
<div class="d-flex">
    @include('components.layouts.sidebar')
    <main id="main-content" class="main-content flex-fill p-4">
        <div class="glass-bg">
            <h1 class="historial-header">
                <i class="fas fa-notes-medical"></i>
                Historial Clínico
            </h1>
            
            @if($historial)
                <div class="mb-3">
                    <label class="form-label">Nombre del Paciente:</label>
                    <div class="form-control-plaintext">{{ $historial->nombrePaciente }}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Última Actualización:</label>
                    <div class="form-control-plaintext">{{ \Carbon\Carbon::parse($historial->updated_at)->format('d/m/Y H:i') }}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Resumen Clínico:</label>
                    @if($soloLectura)
                        <div class="border rounded p-3 bg-light">{{ $historial->resumen }}</div>
                    @elseif($puedeEditar)
                        <form action="/historialClinico/editar" method="POST">
                            @csrf
                            <input type="hidden" name="idHistorial" value="{{ $historial->idHistorial }}">
                            <textarea name="resumen" class="form-control mb-2" rows="7" required>{{ $historial->resumen }}</textarea>
                            <button type="submit" class="btn btn-glass">Guardar Cambios</button>
                        </form>
                    @endif
                </div>
                @if(auth()->user()->hasRole('Admin'))
                    <form action="/historialClinico/eliminar" method="POST" onsubmit="return confirm('¿Seguro de eliminar este historial?');">
                        @csrf
                        <input type="hidden" name="idHistorial" value="{{ $historial->idHistorial }}">
                        <button type="submit" class="btn btn-danger mt-2">Eliminar</button>
                    </form>
                @endif
            @else
                <div class="alert alert-warning text-center mt-4">
                    No existe historial clínico para este paciente.
                </div>
            @endif
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Sidebar toggle funcional
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');
        const toggleBtn = document.getElementById('sidebarToggle');
        if (sidebar && toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-collapsed');
                main.classList.toggle('main-collapsed');
            });
        }
    });
</script>
</body>
</html>
