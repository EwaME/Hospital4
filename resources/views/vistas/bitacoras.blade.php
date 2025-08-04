<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bitácoras</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
    :root {
        --color-create: #18B981;
        --color-edit: #1976D2;
        --color-delete: #e05c3c;
        --color-login: #7e57c2;
        --color-logout: #0097a7;
        --color-export-csv: #22c55e;
        --color-export-pdf: #ef4444;
        --color-export-excel: #2e7d32;
    }
    .with-sidebar {
        padding-left: 220px;
        transition: padding-left 0.22s;
    }
    @media (max-width: 991px) {
        .with-sidebar { padding-left:0!important;}
    }
    .glass-bg {
        background: linear-gradient(135deg, rgba(248,252,255,0.97) 0%, rgba(48,107,165,0.09) 100%);
        border-radius: 2rem;
        border: 1.5px solid #b5d5fa;
        box-shadow: 0 8px 28px 0 rgba(0, 80, 158, 0.14), 0 2px 12px #00509e13;
        backdrop-filter: blur(18px);
        padding: 2.4rem 2.1rem 2.1rem 2.1rem;
        margin-top: 3.3rem;
        animation: fade-in-up 0.7s cubic-bezier(.4,2,.6,1) both;
    }
    .table-glass {
        background: rgba(255,255,255,0.98);
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 2px 16px #00509e10;
        border: 1.3px solid #e3f1ff;
        transition: box-shadow 0.2s;
    }
    .table-glass th, .table-glass td {
        vertical-align: middle !important;
        padding: 0.8em 1em;
    }
    .table-glass th {
        font-size: 1.04rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }
    .glass-filter {
        background: rgba(244,250,255,0.96);
        border-radius: 1.5rem;
        border: 1.2px solid #cfe7fa;
        box-shadow: 0 2px 18px #00509e08;
        margin-bottom:1.7rem;
    }
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(40px);}
        to { opacity: 1; transform: translateY(0);}
    }
    /* Botones exportar personalizados */
    .btn-export-csv {
        background: linear-gradient(92deg, var(--color-export-csv) 65%, #96f2d7 100%);
        color: #fff !important;
        font-weight: 500;
        border: none;
        border-radius: 0.9em;
        box-shadow: 0 2px 12px #00509e18;
        padding: 0.49em 1.2em;
        font-size: 1.07em;
    }
    .btn-export-csv:hover { background: linear-gradient(92deg, #129653 80%, #b9fbc0 100%);}
    .btn-export-pdf {
        background: linear-gradient(92deg, var(--color-export-pdf) 70%, #fbbebe 100%);
        color: #fff !important;
        font-weight: 500;
        border: none;
        border-radius: 0.9em;
        box-shadow: 0 2px 12px #00509e18;
        padding: 0.49em 1.2em;
        font-size: 1.07em;
    }
    .btn-export-pdf:hover { background: linear-gradient(92deg, #d32f2f 80%, #ffe5e5 100%);}
    .btn-export-excel {
        background: linear-gradient(92deg, var(--color-export-excel) 60%, #a8e6cf 100%);
        color: #fff !important;
        font-weight: 500;
        border: none;
        border-radius: 0.9em;
        box-shadow: 0 2px 12px #00509e18;
        padding: 0.49em 1.2em;
        font-size: 1.07em;
    }
    .btn-export-excel:hover { background: linear-gradient(92deg, #228B22 80%, #b2f7c1 100%);}
    .badge-action {
        font-size: 1em;
        padding: .45em 1em;
        border-radius: 11px;
        font-weight: 700;
        letter-spacing: .01em;
        display: inline-block;
        box-shadow: 0 1px 6px #1976d218;
        cursor: pointer;
        transition: transform .13s;
    }
    .badge-action[data-action="crear"] { background: linear-gradient(92deg, #e8fff5 65%, var(--color-create) 100%); color: var(--color-create);}
    .badge-action[data-action="actualizar"] { background: linear-gradient(92deg, #eaf1fd 65%, var(--color-edit) 100%); color: var(--color-edit);}
    .badge-action[data-action="eliminar"] { background: linear-gradient(92deg, #fff0ed 55%, var(--color-delete) 100%); color: var(--color-delete);}
    .badge-action[data-action="login"] { background: linear-gradient(92deg, #f3e9fa 65%, var(--color-login) 100%); color: var(--color-login);}
    .badge-action[data-action="logout"] { background: linear-gradient(92deg, #e0f7fa 65%, var(--color-logout) 100%); color: var(--color-logout);}
    .badge-action[data-action="exportar"] { background: linear-gradient(92deg, #fffbe7 65%, #ebc634 100%); color: #d39e00;}
    .badge-action[data-action="ver"] { background: linear-gradient(92deg, #e9f5ff 65%, #1976d2 100%); color: #1976d2;}
    .badge-action[data-action="otro"] { background: linear-gradient(92deg, #f5f6fa 65%, #bdbdbd 100%); color: #616161;}
    .badge-action[data-action="desconocido"] { background: linear-gradient(92deg, #f3e2e2 65%, #888 100%); color: #888;}
    .table-glass tr.fila-delete { background: linear-gradient(92deg,#ffe9e9 80%,#fff3f3 100%);}
    .table-glass tr.fila-update { background: linear-gradient(92deg,#eaf6ff 60%,#d5eaff 100%);}
    .table-glass tr.fila-login { background: linear-gradient(92deg,#f5e9ff 60%,#f1ebff 100%);}
    .table-glass tr.fila-logout { background: linear-gradient(92deg,#e9fcfc 60%,#ebf9f9 100%);}
    /* Tooltip personalizado */
    .badge-action[data-bs-toggle="tooltip"] {
        position: relative;
    }
    .badge-action[data-bs-toggle="tooltip"]:hover {
        transform: scale(1.08);
        z-index: 2;
    }
    @media (max-width: 575px) {
        .glass-bg { padding: 1.1rem 0.2rem; }
        .table-glass th, .table-glass td { font-size: .93rem;}
        h1 { font-size:1.15rem;}
        .btn-glass, .btn-ico { font-size: 1em; padding: 0.33em 0.88em;}
    }
    </style>
</head>
<body style="overflow-x:hidden;">
@include('components.layouts.sidebar')

<main class="with-sidebar flex-fill p-3" style="min-height:100vh;">
    <div class="glass-bg mx-auto" style="max-width: 1150px;">
        <h1 class="text-center mb-4" style="font-weight:900;font-size:2.1rem;letter-spacing:.01em;color:#00509e;">
            <i class="fa-solid fa-clipboard-list me-2" style="color:#18B981;"></i>
            Bitácora del Sistema
        </h1>
        <form method="get" class="row g-2 mb-4 px-2 py-3 glass-filter align-items-end">
            <div class="col-md-3">
                <label class="form-label mb-1" style="color:#1976d2;">Usuario</label>
                <select name="usuario" class="form-select">
                    <option value="">Todos</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ request('usuario') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1" style="color:#1976d2;">Acción</label>
                <input type="text" name="accion" class="form-control" placeholder="Acción" value="{{ request('accion') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1" style="color:#1976d2;">Módulo</label>
                <select name="modelo" class="form-select">
                    <option value="">Todos</option>
                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo }}" {{ request('modelo') == $modelo ? 'selected' : '' }}>
                            {{ ucfirst($modelo) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1" style="color:#1976d2;">Fecha</label>
                <input type="date" name="fecha" class="form-control" value="{{ request('fecha') }}">
            </div>
            <div class="col-md-2 d-grid gap-2">
                <button class="btn btn-glass w-100" type="submit">
                    <i class="fas fa-filter me-1"></i> Filtrar
                </button>
            </div>
            <div class="col-md-1 d-grid gap-2">
                <a href="{{ route('bitacoras.index') }}" class="btn btn-secondary w-100" title="Limpiar Filtros">
                    <i class="fas fa-eraser"></i>
                </a>
            </div>
        </form>
        
        <div class="mb-3 d-flex flex-wrap gap-2 justify-content-end px-2">
            <a href="{{ route('bitacoras.exportar-csv', request()->query()) }}" class="btn btn-export-csv" title="Exportar a CSV">
                <i class="fas fa-file-csv"></i> CSV
            </a>
            <a href="{{ route('bitacoras.exportar-pdf', request()->query()) }}" class="btn btn-export-pdf" title="Exportar a PDF">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            <a href="{{ route('bitacoras.exportar-excel') }}" class="btn btn-export-excel" title="Exportar a Excel">
                <i class="fas fa-file-excel"></i> Excel
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-glass align-middle w-100 mt-3">
                <thead style="background:linear-gradient(92deg,#00509e 90%,#18B981 100%);color:#fff;">
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Acción</th>
                        <th>Descripción</th>
                        <th>Módulo</th>
                        <th>Fecha</th>
                        <th>IP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bitacoras as $bitacora)
                    @php
                        $accion = strtolower($bitacora->accion ?? 'otro');
                        $badgeAction = 'otro';
                        $rowClass = '';
                        $tooltip = ucfirst($accion);
                        // Detecta tipo de acción:
                        if(str_contains($accion,'crear') || str_contains($accion,'add') || str_contains($accion,'registrar')) {
                            $badgeAction = 'crear'; $rowClass='';
                            $tooltip = 'Creación';
                        } else if(str_contains($accion,'editar') || str_contains($accion,'modificar') || str_contains($accion,'update')) {
                            $badgeAction = 'actualizar'; $rowClass='fila-update';
                            $tooltip = 'Actualización';
                        } else if(str_contains($accion,'eliminar') || str_contains($accion,'borrar') || str_contains($accion,'delete')) {
                            $badgeAction = 'eliminar'; $rowClass='fila-delete';
                            $tooltip = 'Eliminación';
                        } else if(str_contains($accion,'login') || str_contains($accion,'inicio')) {
                            $badgeAction = 'login'; $rowClass='fila-login';
                            $tooltip = 'Inicio de sesión';
                        } else if(str_contains($accion,'logout') || str_contains($accion,'cerrar')) {
                            $badgeAction = 'logout'; $rowClass='fila-logout';
                            $tooltip = 'Cierre de sesión';
                        } else if(str_contains($accion,'exportar')) {
                            $badgeAction = 'exportar'; $rowClass='';
                            $tooltip = 'Exportación';
                        } else if(str_contains($accion,'ver') || str_contains($accion,'consultar')) {
                            $badgeAction = 'ver'; $rowClass='';
                            $tooltip = 'Consulta';
                        }
                    @endphp
                    <tr class="{{ $rowClass }}">
                        <td class="fw-bold">{{ $bitacora->idBitacora }}</td>
                        <td>
                            <span class="badge rounded-pill bg-info text-dark" style="font-weight:500;">
                                {{ $bitacora->usuario->nombre ?? 'Usuario desconocido' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-action" data-action="{{ $badgeAction }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $tooltip }}">
                                {{ ucfirst($bitacora->accion) }}
                            </span>
                        </td>
                        <td>{{ $bitacora->descripcion }}</td>
                        <td>
                            <span class="badge bg-light text-primary border" style="font-size:0.98em;">
                                {{ $bitacora->modelo ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <span style="font-size:0.98em;">
                            {{ $bitacora->created_at ? \Carbon\Carbon::parse($bitacora->created_at)->format('d/m/Y H:i') : '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border" style="font-size:0.97em;">{{ $bitacora->ip ?? '-' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay registros en la bitácora.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $bitacoras->withQueryString()->links() }}
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
</body>
</html>
