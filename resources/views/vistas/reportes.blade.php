<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Reportes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
    <style>
        body { background: #f8fafc; }
        .reporte-card {
            background: linear-gradient(104deg,#e9fdf7 80%,#d2e6ff 100%);
            transition: transform .15s, box-shadow .15s;
            border: 2px solid #18b98133;
        }
        .reporte-card:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 6px 30px #16a08518;
            border-color: #18b981;
        }
        .reporte-icon {
            font-size: 2.6rem;
            color: #16a085;
        }
    </style>
</head>
<body>
<div class="container py-4">
    @include('components.layouts.sidebar')
    <h2 class="fw-bold text-center mb-4"><i class="fas fa-chart-bar me-2"></i>Menú de Reportes</h2>
    <div class="row g-4 justify-content-center">
        <!-- Reporte de Citas -->
        <div class="col-md-6 col-lg-4">
            <div class="reporte-card p-4 rounded-4 shadow text-center h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="reporte-icon mb-3"><i class="fas fa-calendar-check"></i></div>
                    <h5 class="fw-bold mb-3">Reporte de Citas</h5>
                    <form action="{{ route('reportes.citas.pdf') }}" method="GET" target="_blank" class="row g-2 align-items-end justify-content-center">
                        <div class="col-12">
                            <label class="form-label">Fecha inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Fecha fin</label>
                            <input type="date" name="fecha_fin" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select">
                                <option value="">Todos</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Confirmada">Confirmada</option>
                                <option value="Cancelada">Cancelada</option>
                                <option value="Finalizada">Finalizada</option>
                            </select>
                        </div>
                        <div class="col-12 text-center mt-2">
                            <button class="btn btn-success w-100"><i class="fas fa-file-pdf"></i> Exportar PDF</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Reporte de Consultas -->
        <div class="col-md-6 col-lg-4">
            <div class="reporte-card p-4 rounded-4 shadow text-center h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="reporte-icon mb-3"><i class="fas fa-notes-medical"></i></div>
                    <h5 class="fw-bold mb-3">Reporte de Consultas</h5>
                    <form action="{{ route('reportes.consultas.pdf') }}" method="GET" target="_blank" class="row g-2 align-items-end justify-content-center">
                        <div class="col-12">
                            <label class="form-label">Fecha inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Fecha fin</label>
                            <input type="date" name="fecha_fin" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select">
                                <option value="">Todos</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Confirmada">Confirmada</option>
                                <option value="Cancelada">Cancelada</option>
                                <option value="Finalizada">Finalizada</option>
                            </select>
                        </div>
                        <div class="col-12 text-center mt-2">
                            <button class="btn btn-success w-100"><i class="fas fa-file-pdf"></i> Exportar PDF</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Futuras tarjetas de reportes (ejemplo) -->
        <div class="col-md-6 col-lg-4">
            <div class="reporte-card p-4 rounded-4 shadow text-center h-100 d-flex flex-column justify-content-center opacity-50">
                <div>
                    <div class="reporte-icon mb-3"><i class="fas fa-user-md"></i></div>
                    <h5 class="fw-bold mb-2">Reporte de Doctores</h5>
                    <small>Próximamente</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="reporte-card p-4 rounded-4 shadow text-center h-100 d-flex flex-column justify-content-center opacity-50">
                <div>
                    <div class="reporte-icon mb-3"><i class="fa-solid fa-bed-pulse"></i>
                    <h5 class="fw-bold mb-2">Reporte de Pacientes</h5>
                    <small>Próximamente</small>
                </div>
            </div>
        </div>  
    </div>
</div>
</body>
</html>
