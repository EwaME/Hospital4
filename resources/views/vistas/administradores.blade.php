<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Administradores</title>
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
        @media (max-width: 991.98px) {
            .main-content { margin-left: 0; }
        }
        .glass-bg {
            background: linear-gradient(135deg, rgba(248,252,255,0.97) 0%, rgba(48,107,165,0.09) 100%);
            border-radius: 1.7rem;
            border: 1.5px solid #b5d5fa;
            box-shadow: 0 10px 36px 0 rgba(0, 80, 158, 0.14), 0 2px 12px #00509e13;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 2.7rem 2.1rem 2rem 2.1rem;
            margin-top: 3.7rem;
            animation: fade-in-up 0.8s cubic-bezier(.4,2,.6,1) both;
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(60px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .admin-header {
            font-size: 2.1rem;
            font-weight: 900;
            color: #00509e;
            text-shadow: 0 2px 16px #00509e23;
            letter-spacing: 0.01em;
            margin-bottom: 2.1rem;
            text-align: center;
            display: flex;
            gap: .55em;
            justify-content: center;
            align-items: center;
        }
        .admin-header .fa-user-shield {
            color: #18B981;
            font-size: 1.17em;
            filter: drop-shadow(0 2px 9px #00509e21);
        }
        .btn-glass {
            background: linear-gradient(92deg, #14996b 40%, #18B981 100%);
            color: #fff !important;
            font-weight: 500;
            border: none;
            border-radius: 0.9em;
            box-shadow: 0 2px 12px #00509e18;
            transition: background 0.2s, transform 0.17s, box-shadow 0.2s;
        }
        .btn-glass:hover, .btn-glass:focus {
            background: linear-gradient(92deg, #0eab78 30%, #16e59d 100%);
            box-shadow: 0 8px 18px #00509e2c;
            transform: scale(1.045);
            color: #fff;
        }
        .table-glass {
            background: rgba(255,255,255,0.95);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 2px 16px #00509e10;
            border: 1.3px solid #e3f1ff;
            transition: box-shadow 0.2s;
        }
        .table-glass th, .table-glass td {
            vertical-align: middle !important;
            padding: 0.84em 1em;
            font-size: 1.01rem;
        }
        .table-glass th {
            background: rgba(11, 112, 187, 0.13);
            color: #00509e;
            font-size: 1.11rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            position: sticky;
            top: 0;
            z-index: 2;
            box-shadow: 0 2px 7px #00509e11;
        }
        .table-glass tr.table-danger td {
            background: rgba(245, 123, 123, 0.08) !important;
        }
        .badge-admin {
            display: inline-block;
            padding: .36em .9em;
            border-radius: 9px;
            font-weight: 600;
            font-size: .98em;
            border: 1px solid #e0ebf5;
            background: linear-gradient(92deg,#eaf6ff 70%,#b8e7fa 100%);
            color: #1976D2;
        }
        .badge-eliminado {
            background: linear-gradient(92deg,#ffe9e9 70%,#ffc1c1 100%);
            color: #da3a38;
            border-color: #ffbdbd;
        }
        .badge-activo {
            background: linear-gradient(95deg,#eafff3 60%,#b7f9d3 100%);
            color: #16a14a;
            border-color: #bff5d2;
        }
        .btn-warning.btn-sm {
            color: #9c7701;
            background: linear-gradient(92deg,#fff3d1 60%,#ffeab1 100%);
            border: 1px solid #f7e7a5;
        }
        .btn-warning.btn-sm:hover {
            background: #ffe79b;
            color: #b98d00;
        }
        @media (max-width: 600px) {
            .glass-bg { padding: 0.95rem 0.2rem; }
            .admin-header { font-size: 1.17rem;}
            .btn-glass { font-size: 1em; padding: 0.36em 1.08em;}
            .table-glass th, .table-glass td { font-size: .91rem;}
        }
        /* Modales glassy */
        .modal-content.glass-bg {
            border-radius: 1.17em !important;
            box-shadow: 0 10px 36px 0 rgba(0, 80, 158, 0.13), 0 2px 12px #00509e10;
        }
        .modal-header {
            border-bottom: none;
            background: transparent;
            padding-bottom: 0;
        }
        .modal-title {
            color: #00509e;
            font-weight: bold;
            font-size: 1.21rem;
            letter-spacing: 0.01em;
        }
        .modal-footer {
            border-top: none;
            background: transparent;
            padding-top: 0;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }
    </style>
</head>
<body>
<div class="d-flex">
    @include('components.layouts.sidebar')
    <main class="main-content flex-fill p-4">
        <div class="glass-bg mx-auto" style="max-width: 1050px;">
            <div class="admin-header mb-4">
                <i class="fas fa-user-shield"></i>
                Gestión de Administradores
            </div>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-glass" data-bs-toggle="modal" data-bs-target="#modalCrear">
                    <i class="fas fa-plus-circle me-1"></i>Agregar Administrador
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-glass align-middle w-100">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Cargo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($administradores as $admin)
                        <tr @if($admin->trashed()) class="table-danger" @endif>
                            <td>{{ $admin->usuario->nombre ?? '-' }}</td>
                            <td>{{ $admin->usuario->email ?? '-' }}</td>
                            <td>{{ $admin->cargo ?? '-' }}</td>
                            <td>
                                @if($admin->trashed())
                                    <span class="badge badge-admin badge-eliminado"><i class="fa fa-times-circle me-1"></i>Eliminado</span>
                                @else
                                    <span class="badge badge-admin badge-activo"><i class="fa fa-check-circle me-1"></i>Activo</span>
                                @endif
                            </td>
                            <td>
                                @if(!$admin->trashed())
                                    <button class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditar"
                                            data-id="{{ $admin->idAdministrador }}"
                                            data-cargo="{{ $admin->cargo }}">
                                        <i class="fa fa-edit"></i> Editar
                                    </button>
                                    <button class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEliminar"
                                            data-id="{{ $admin->idAdministrador }}">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
                                @else
                                    <form action="{{ route('administradores.restore', $admin->idAdministrador) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fa fa-undo"></i> Restaurar
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Modal Crear -->
<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content glass-bg" action="{{ route('administradores.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearLabel"><i class="fa fa-plus-circle me-1 text-success"></i> Nuevo Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label class="form-label">Usuario:</label>
                    <select name="idUsuario" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->nombre }} ({{ $usuario->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Cargo (opcional):</label>
                    <input type="text" name="cargo" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-glass">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content glass-bg" id="formEditar" method="POST">
            @csrf @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel"><i class="fa fa-edit text-primary me-1"></i> Editar Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="editId">
                <div class="mb-2">
                    <label class="form-label">Cargo:</label>
                    <input type="text" name="cargo" class="form-control" id="editCargo">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content glass-bg" id="formEliminar" method="POST">
            @csrf @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel"><i class="fa fa-trash text-danger me-1"></i> Eliminar Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar este administrador?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-danger">Eliminar</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal editar
    var modalEditar = document.getElementById('modalEditar');
    modalEditar.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var cargo = button.getAttribute('data-cargo') || '';
        var form = document.getElementById('formEditar');
        form.action = '/administradores/' + id;
        document.getElementById('editId').value = id;
        document.getElementById('editCargo').value = cargo;
    });

    // Modal eliminar
    var modalEliminar = document.getElementById('modalEliminar');
    modalEliminar.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = document.getElementById('formEliminar');
        form.action = '/administradores/' + id;
    });
});
</script>
</body>
</html>
