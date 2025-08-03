<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pacientes</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
            border-radius: 1.7rem;
            border: 1.5px solid #b5d5fa;
            box-shadow: 0 10px 36px 0 rgba(0, 80, 158, 0.14), 0 2px 12px #00509e13;
            backdrop-filter: blur(20px);
            padding: 2.7rem 2.1rem 2rem 2.1rem;
            margin-top: 3.7rem;
            animation: fade-in-up 0.8s cubic-bezier(.4,2,.6,1) both;
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(60px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .pacientes-header {
            font-size: 2.2rem;
            font-weight: 900;
            color: #00509e;
            text-shadow: 0 2px 16px #00509e23;
            letter-spacing: 0.01em;
            margin-bottom: 2.1rem;
            text-align: center;
            display: flex;
            gap: .5em;
            justify-content: center;
            align-items: center;
        }
        .pacientes-header .fa-bed-pulse {
            color: #18B981;
            font-size: 1.2em;
            filter: drop-shadow(0 2px 9px #00509e21);
        }
        .table-glass {
            background: rgba(255,255,255,0.96);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 2px 16px #00509e10;
            border: 1.3px solid #e3f1ff;
            transition: box-shadow 0.2s;
        }
        .table-glass th, .table-glass td {
            vertical-align: middle !important;
            padding: 0.78em 1em;
        }
        .table-glass th {
            background: rgba(11, 112, 187, 0.13);
            color: #00509e;
            font-size: 1.08rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            position: sticky;
            top: 0;
            z-index: 3;
            box-shadow: 0 2px 7px #00509e11;
        }
        .table-glass tbody tr:hover {
            background: rgba(24,185,129,0.12) !important;
        }
        .table-glass td {
            font-size: 1.01rem;
            color: #263253;
            transition: color 0.2s;
        }
        .fw-bold { font-weight: 600 !important; }
        .btn-glass, .btn-ico {
            background: linear-gradient(92deg, #14996b 40%, #18B981 100%);
            color: #fff !important;
            font-weight: 500;
            border: none;
            border-radius: 0.9em;
            box-shadow: 0 2px 12px #00509e18;
            transition: background 0.2s, transform 0.17s, box-shadow 0.2s;
        }
        .btn-glass:hover, .btn-ico:hover, .btn-glass:focus, .btn-ico:focus {
            background: linear-gradient(92deg, #0eab78 30%, #16e59d 100%);
            box-shadow: 0 8px 18px #00509e2c;
            transform: scale(1.057);
            color: #fff;
        }
        .btn-ico {
            padding: 0.53em 0.68em;
            border-radius: 50%;
            font-size: 1.07em;
            margin: 0 .13em;
            background: linear-gradient(88deg, #e1f6f0 40%, #d1f6ff 100%);
            color: #14996b !important;
            border: 1.4px solid #e0ebf5;
            box-shadow: 0 1px 8px #14996b17;
        }
        .btn-ico.edit { color: #1976D2 !important; border-color: #bee1ff; background: #f6faff;}
        .btn-ico.edit:hover { background: #e2f3ff; color: #125fb7 !important;}
        .btn-ico.del { color: #e05c3c !important; border-color: #ffdad2; background: #fff7f6;}
        .btn-ico.del:hover { background: #ffebe6; color: #af2d08 !important;}
        .btn-ico.historial { color: #18b981 !important; border-color: #cbf8ea; background: #edfcf8;}
        .btn-ico.historial:hover { background: #d8faee; color: #089f73 !important;}
        .btn-glass i, .btn-ico i { margin-right: 0; }
        .form-control, .form-select {
            border-radius: 0.75em !important;
            background: rgba(255,255,255,0.93) !important;
            border: 1.4px solid #c7e5f8 !important;
            box-shadow: 0 1.5px 6px #00509e11;
            font-size: 1.04em !important;
            transition: border 0.18s, box-shadow 0.22s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #18b981 !important;
            box-shadow: 0 0 0 2px #18b9813c !important;
        }
        label.form-label, label {
            font-weight: 600;
            color: #1976d2;
            margin-bottom: .5em;
        }
        .modal-content.glass-bg {
            padding: 2rem 2.1rem 1.5rem 2.1rem !important;
            border-radius: 1.3rem;
        }
        .modal-header {
            border-bottom: none;
            background: transparent;
            padding-bottom: 0;
        }
        .modal-title {
            color: #00509e;
            font-weight: bold;
            font-size: 1.22rem;
            letter-spacing: 0.02em;
        }
        .modal-footer {
            border-top: none;
            background: transparent;
            padding-top: 0;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }
        @media (max-width: 575px) {
            .glass-bg { padding: 0.7rem 0.05rem; }
            .table-glass th, .table-glass td { font-size: .91rem;}
            .pacientes-header { font-size: 1.12rem;}
            .btn-glass, .btn-ico { font-size: 1em; padding: 0.37em 0.71em;}
            .modal-content.glass-bg { padding: 1.1rem 0.8rem 1.1rem 0.8rem !important;}
        }
    </style>
</head>

<body>
<div class="d-flex">
    @include('components.layouts.sidebar')

    <main id="main-content" class="main-content flex-fill p-4">
        <div class="glass-bg mx-auto" style="max-width: 880px;">
            <h1 class="pacientes-header">
                <i class="fas fa-bed-pulse"></i>
                Gestión de Pacientes
            </h1>

            @role('Admin')
            <div class="d-flex justify-content-end">
                <button class="btn btn-glass mb-3" data-bs-toggle="modal" data-bs-target="#modalCrearPaciente">
                    <i class="fas fa-plus-circle"></i> Agregar Paciente
                </button>
            </div>
            @endrole

            <div class="table-responsive">
                <table class="table table-glass align-middle w-100 mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Género</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacientes as $paciente)
                        <tr>
                            <td class="fw-bold">{{ $paciente->idPaciente }}</td>
                            <td>{{ $paciente->usuario->nombre }}</td>
                            <td>{{ $paciente->fechaNacimiento }}</td>
                            <td>{{ $paciente->genero }}</td>
                            <td>
                                @role('Admin')
                                    <button class="btn btn-ico edit editar"
                                        data-bs-toggle="modal" data-bs-target="#modalEditarPaciente"
                                        data-id="{{ $paciente->idPaciente }}"
                                        data-fecha="{{ $paciente->fechaNacimiento }}"
                                        data-genero="{{ $paciente->genero }}"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-ico del eliminar"
                                        data-bs-toggle="modal" data-bs-target="#modalEliminarPaciente"
                                        data-id="{{ $paciente->idPaciente }}"
                                        title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <a href="{{ route('historialClinico.paciente', $paciente->idPaciente) }}" 
                                    class="btn btn-info">Ver Historial</a>
                                @elserole('Doctor')
                                    <a href="{{ route('historialClinico.paciente', $paciente->idPaciente) }}" 
                                    class="btn btn-info">Ver Historial</a>
                                @endrole
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

@role('Admin')
<!-- Modal Crear -->
<div class="modal fade" id="modalCrearPaciente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/pacientes/guardar" method="POST" class="modal-content glass-bg" id="formCrearPaciente">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Crear Paciente</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Usuario</label>
                    <select name="idPaciente" class="form-control" required>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Fecha de Nacimiento</label>
                    <input type="date" name="fechaNacimiento" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Género</label>
                    <select name="genero" class="form-control" required>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Guardar</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" id="cancelarCrearPaciente">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modalEditarPaciente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/pacientes/editar" method="POST" class="modal-content glass-bg">
            @csrf
            <input type="hidden" name="idPaciente" id="edit_idPaciente">
            <div class="modal-header">
                <h5 class="modal-title">Editar Paciente</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Fecha de Nacimiento</label>
                    <input type="date" name="fechaNacimiento" id="edit_fechaNacimiento" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Género</label>
                    <select name="genero" id="edit_genero" class="form-control" required>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Actualizar</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="modalEliminarPaciente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/pacientes/eliminar" method="POST" class="modal-content glass-bg">
            @csrf
            <input type="hidden" name="idPaciente" id="delete_idPaciente">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Paciente</h5>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar este paciente?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit">Eliminar</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>
@endrole

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('.editar').on('click', function () {
            $('#edit_idPaciente').val($(this).data('id'));
            $('#edit_fechaNacimiento').val($(this).data('fecha'));
            $('#edit_genero').val($(this).data('genero'));
        });

        $('.eliminar').on('click', function () {
            $('#delete_idPaciente').val($(this).data('id'));
        });

        $('#cancelarCrearPaciente').on('click', function () {
            $('#formCrearPaciente')[0].reset();
        });
    });

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
