<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Hospital EKO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #e9f3ff 0%, #d5f3ea 100%);
            min-height: 100vh;
        }
        .glass-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.97) 0%, rgba(85,183,255,0.10) 100%);
            border-radius: 1.4rem;
            border: 1.5px solid #b5d5fa;
            box-shadow: 0 8px 36px 0 rgba(0, 80, 158, 0.13), 0 2px 12px #00509e13;
            backdrop-filter: blur(20px);
        }
        .glass-stats {
            background: linear-gradient(120deg,rgba(232,246,255,0.98) 0%,rgba(191,250,237,0.10) 100%);
            border-radius: 1rem;
            border: 1.1px solid #d8ebfc;
            box-shadow: 0 4px 28px 0 #00509e13, 0 2px 8px #1976d226;
        }
        .glass-title {
            color: #00509e;
            font-weight: 900;
            letter-spacing: 0.01em;
            text-shadow: 0 2px 12px #00509e19;
        }
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
            }
        }
        .main-content {
            margin-left: 260px;
            transition: margin-left 0.25s;
        }
        .main-collapsed {
            margin-left: 70px !important;
        }
        @media (max-width: 991.98px) {
            .glass-card, .glass-stats { padding: 1.2rem !important; }
            .glass-title { font-size: 1.2rem !important;}
        }
        .glass-stats .border-bottom:last-child { border-bottom: none !important;}

    </style>
</head>
<body>
<div class="d-flex">

    @include('components.layouts.sidebar')

    <!-- MAIN CONTENT -->
    <main id="main-content" class="main-content flex-fill p-4">
        <div class="container-fluid">
            <div class="glass-card p-4 mb-4" style="min-height: 86vh;">
                <div>
                    <!-- TÍTULO -->
                    <h1 class="fs-2 fw-bold glass-title text-center mb-5">📊 Estadísticas Generales</h1>

                    <!-- ============ PACIENTE ============ -->
                    @role('Paciente')
                        @php
                            $proxima = $estadisticas['paciente']['proximaCita'] ?? null;
                            $citas = $estadisticas['paciente']['citasProximas'] ?? collect();
                        @endphp
                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <div class="glass-stats p-4 h-100">
                                    <h2 class="fs-4 fw-bold text-success mb-2">📅 Próxima Cita</h2>
                                    @if($proxima)
                                        <div class="fw-semibold mb-1">{{ $proxima->fechaCita }} – {{ $proxima->horaCita }}</div>
                                        <div class="mb-1">Con <span class="fw-bold">{{ $proxima->doctor->usuario->nombre ?? '-' }}</span></div>
                                        <div class="text-muted mb-2">Ubicación: <span class="fw-semibold">Consultorio</span></div>
                                        <span class="badge rounded-pill
                                            {{ $proxima->estadoCita == 'Pendiente' ? 'bg-warning text-dark' : 'bg-success' }}">
                                            {{ $proxima->estadoCita }}
                                        </span>
                                    @else
                                        <div class="text-muted">No tienes citas próximas.</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="glass-stats p-4 h-100">
                                    <h2 class="fs-5 fw-bold text-primary mb-3">📋 Tus próximas citas</h2>
                                    <div>
                                        @forelse($citas as $cita)
                                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                                <div>
                                                    <div class="fw-semibold">{{ $cita->fechaCita }} – {{ $cita->horaCita }}</div>
                                                    <div class="small text-muted">Dr(a): <span class="fw-bold">{{ $cita->doctor->usuario->nombre ?? '-' }}</span></div>
                                                </div>
                                                <span class="badge rounded-pill
                                                    {{ $cita->estadoCita == 'Pendiente' ? 'bg-warning text-dark' : 'bg-success' }}">
                                                    {{ $cita->estadoCita }}
                                                </span>
                                            </div>
                                        @empty
                                            <div class="text-muted">No tienes citas próximas.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endrole

                    <!-- ============ DOCTOR ============ -->
                    @role('Doctor')
                        @php
                            $docStats = $estadisticas['doctor'] ?? [];
                        @endphp
                        <div class="row g-4">
                            <div class="col-6 col-md-3">
                                <div class="glass-stats p-4 text-center h-100">
                                    <div class="fs-2">🧑‍🤝‍🧑</div>
                                    <div class="fs-4 fw-bold">{{ $docStats['totalPacientes'] ?? 0 }}</div>
                                    <div>Pacientes atendidos</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="glass-stats p-4 text-center h-100">
                                    <div class="fs-2">⏰</div>
                                    <div class="fs-4 fw-bold">{{ $docStats['citasPendientesHoy'] ?? 0 }}</div>
                                    <div>Citas pendientes hoy</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="glass-stats p-4 text-center h-100">
                                    <div class="fs-2">🩺</div>
                                    <div class="fs-4 fw-bold">{{ $docStats['consultasSemana'] ?? 0 }}</div>
                                    <div>Consultas esta semana</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="glass-stats p-4 text-center h-100">
                                    <div class="fs-2">⭐</div>
                                    <div class="fs-4 fw-bold">{{ $docStats['promedioSatisfaccion'] ?? 'N/A' }}@if($docStats['promedioSatisfaccion'] !== 'N/A')/5 @endif</div>
                                    <div>Satisfacción promedio</div>
                                </div>
                            </div>
                        </div>

                        <div class="glass-stats p-4 mt-4">
                            <h2 class="fs-5 fw-bold text-primary mb-3">📋 Citas próximas</h2>
                            @forelse($docStats['citasProximas'] ?? [] as $cita)
                                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                    <div>
                                        <div class="fw-semibold">{{ $cita->fechaCita }} – {{ $cita->horaCita }}</div>
                                        <div class="small text-muted">
                                            Paciente: 
                                            <span class="fw-bold">{{ $cita->paciente->usuario->nombre ?? '-' }}</span>
                                        </div>
                                    </div>
                                    <span class="badge rounded-pill
                                        {{ $cita->estadoCita == 'CONFIRMADA' ? 'bg-warning text-dark' : 'bg-success' }}">
                                        {{ $cita->estadoCita }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-muted">No hay citas próximas.</div>
                            @endforelse
                        </div>
                    @endrole

                    <!-- ============ ADMIN ============ -->
                    @role('Admin')
                        @php
                            $admin = $estadisticas['admin'] ?? [];
                        @endphp
                        <div class="row g-4">
                            <div class="col-6 col-md-3">
                                <div class="glass-stats p-4 text-center h-100">
                                    <div class="fs-2">👥</div>
                                    <div class="fs-4 fw-bold">{{ $admin['totalUsuarios'] ?? 0 }}</div>
                                    <div>Usuarios totales</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="glass-stats p-4 text-center h-100">
                                    <div class="fs-2">👨‍⚕️</div>
                                    <div class="fs-4 fw-bold">{{ $admin['totalDoctores'] ?? 0 }}</div>
                                    <div>Doctores</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="glass-stats p-4 text-center h-100">
                                    <div class="fs-2">🧑‍🤝‍🧑</div>
                                    <div class="fs-4 fw-bold">{{ $admin['totalPacientes'] ?? 0 }}</div>
                                    <div>Pacientes</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="glass-stats p-4 text-center h-100">
                                    <div class="fs-2">🛡️</div>
                                    <div class="fs-4 fw-bold">{{ $admin['totalRoles'] ?? 0 }}</div>
                                    <div>Roles definidos</div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mt-4">
                            <div class="col-12 col-lg-6">
                                <div class="glass-stats p-4 h-100">
                                    <h2 class="fs-5 fw-bold text-primary mb-3">📘 Bitácoras recientes</h2>
                                    @forelse($admin['bitacoras'] ?? [] as $b)
                                        <div class="border-bottom py-2 d-flex align-items-center gap-2" style="font-size: 1.01em;">
                                            <span class="text-muted small" style="min-width: 93px">
                                                <i class="fa-regular fa-clock me-1"></i>
                                                {{ $b->created_at ? $b->created_at->format('d/m H:i') : '#' . $b->idBitacora }}
                                            </span>
                                            <span class="fw-semibold text-primary">{{ $b->usuario->nombre ?? '---' }}</span>
                                            <span class="badge
                                                @switch(strtolower($b->accion))
                                                    @case('delete') bg-danger @break
                                                    @case('update') bg-warning text-dark @break
                                                    @case('create') bg-success @break
                                                    @case('login') bg-primary @break
                                                    @case('logout') bg-secondary @break
                                                    @default bg-info text-dark
                                                @endswitch
                                                text-uppercase"
                                                style="font-size:0.92em;">
                                                {{ ucfirst($b->accion) }}
                                            </span>
                                            <span class="ms-2 text-break d-inline-block" style="max-width:170px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"
                                                title="{{ $b->descripcion }}">
                                                {{ Str::limit(strip_tags($b->descripcion), 45) }}
                                            </span>
                                            @if(strlen($b->descripcion) > 20)
                                                <a tabindex="0" class="ms-2 text-decoration-none text-info" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $b->descripcion }}">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="text-muted">No hay movimientos recientes en bitácora.</div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="glass-stats p-4 h-100">
                                    <h2 class="fs-5 fw-bold text-fuchsia-700 mb-3">🆕 Usuarios recientes</h2>
                                    @forelse($admin['usuariosRecientes'] ?? [] as $u)
                                        <div class="border-bottom py-2 d-flex align-items-center gap-2">
                                            <span class="fw-semibold">{{ $u->nombre }}</span>
                                            <span class="badge bg-secondary">
                                                {{ $u->roles->first()->name ?? '-' }}
                                            </span>
                                            <span class="text-muted small">
                                                {{ $u->created_at ? $u->created_at->format('Y-m-d H:i') : '' }}
                                            </span>
                                        </div>
                                    @empty
                                        <div class="text-muted">No hay usuarios recientes.</div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="glass-stats p-4 h-100 mt-2">
                                    <h2 class="fs-5 fw-bold text-success mb-3">💊 Medicamentos entregados</h2>
                                    @forelse($admin['medicamentosEntregados'] ?? [] as $m)
                                        <div class="border-bottom py-2 d-flex flex-column flex-md-row justify-content-between">
                                            <div>
                                                <span class="fw-semibold">{{ $m->medicamento->nombre ?? '-' }}</span>
                                                entregado a
                                                <span class="fw-bold">
                                                    {{ $m->consulta->cita->paciente->usuario->nombre ?? '-' }}
                                                </span>
                                            </div>
                                            <span class="text-muted small">
                                                {{ $m->created_at ? $m->created_at->format('Y-m-d H:i') : '' }}
                                            </span>
                                        </div>
                                    @empty
                                        <div class="text-muted">No hay medicamentos entregados registrados.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endrole
                </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
</body>
</html>