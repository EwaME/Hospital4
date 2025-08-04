<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doctores</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #e9f3ff 0%, #d5f3ea 100%);
            min-height: 100vh;
        }
        .glass-navbar {
            background: linear-gradient(95deg, #fff 75%, #e9f3ff 100%);
            box-shadow: 0 4px 22px #1876d115;
            border-bottom: 1.5px solid #d8eefd;
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 1030;
        }
        .glass-navbar .navbar-brand {
            font-weight: bold;
            color: #1376d3 !important;
            letter-spacing: .03em;
            font-size: 1.22rem;
            text-shadow: 0 2px 14px #b5deff23;
        }
        .glass-navbar .nav-link {
            color: #375e8d !important;
            font-weight: 600;
            border-radius: 1.7em !important;
            padding: 0.68rem 1.15rem;
            margin-bottom: 0.09rem;
            transition: background 0.14s, color 0.16s, box-shadow 0.17s;
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5em;
        }
        .glass-navbar .nav-link.active,
        .glass-navbar .nav-link[aria-current="page"] {
            background: linear-gradient(90deg, #d1e5fa 0%, #d9cafd 100%);
            color: #00509e !important;
            font-weight: 700;
            box-shadow: 0 2px 14px 0 #c6b1f426;
        }
        .glass-navbar .nav-link:hover, .glass-navbar .nav-link:focus {
            background: linear-gradient(90deg, #e6e3fc 50%, #f3eafe 100%);
            color: #6c40ba !important;
            box-shadow: 0 1px 10px #bda8fc24;
        }
        .navbar-toggler {
            border: none !important;
        }
        .navbar-toggler:focus { box-shadow: none; }
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
        .doctores-header {
            font-size: 2.5rem;
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
        .doctores-header .fa-user-doctor {
            color: #18B981;
            font-size: 1.25em;
            filter: drop-shadow(0 2px 9px #00509e21);
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
            padding: 0.85em 1em;
        }
        .table-glass th {
            background: rgba(11, 112, 187, 0.13);
            color: #00509e;
            font-size: 1.11rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            position: sticky;
            top: 0;
            z-index: 3;
            box-shadow: 0 2px 7px #00509e11;
        }
        .table-glass tbody tr:hover {
            background: rgba(24,185,129,0.13) !important;
        }
        .table-glass td {
            font-size: 1.03rem;
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
            font-size: 1.1em;
            margin: 0 .14em;
            background: linear-gradient(88deg, #e1f6f0 40%, #d1f6ff 100%);
            color: #14996b !important;
            border: 1.4px solid #e0ebf5;
            box-shadow: 0 1px 8px #14996b17;
            transition: background 0.2s, color 0.14s, box-shadow 0.2s, border 0.18s;
        }
        .btn-ico.edit { color: #1976D2 !important; border-color: #bee1ff; background: #f6faff;}
        .btn-ico.edit:hover { background: #e2f3ff; color: #125fb7 !important;}
        .btn-ico.del { color: #e05c3c !important; border-color: #ffdad2; background: #fff7f6;}
        .btn-ico.del:hover { background: #ffebe6; color: #af2d08 !important;}
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
        label.form-label {
            font-weight: 600;
            color: #1976d2;
            margin-bottom: .5em;
        }
        .modal-content.glass-bg {
            padding: 2rem 2.1rem 1.5rem 2.1rem !important;
        }
        .modal-header {
            border-bottom: none;
            background: transparent;
            padding-bottom: 0;
        }
        .modal-title {
            color: #00509e;
            font-weight: bold;
            font-size: 1.35rem;
            letter-spacing: 0.02em;
        }
        .modal-footer {
            border-top: none;
            background: transparent;
            padding-top: 0;
        }
        @media (max-width: 575px) {
            .glass-bg { padding: 0.7rem 0.05rem; }
            .table-glass th, .table-glass td { font-size: .91rem;}
            .doctores-header { font-size: 1.17rem;}
            .btn-glass, .btn-ico { font-size: 1em; padding: 0.37em 0.71em;}
            .modal-content.glass-bg { padding: 1.1rem 0.8rem 1.1rem 0.8rem !important;}
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
    </style>
</head>

<body>
@include('components.layouts.sidebar')
<div class="container">
    <div class="glass-bg mx-auto" style="max-width: 850px;">
        <h1 class="doctores-header"><i class="fas fa-user-doctor"></i> Gestión de Doctores</h1>
        <div class="d-flex justify-content-end">
            <button class="btn btn-glass mb-3"
                data-bs-toggle="modal"
                data-bs-target="#modalCrearDoctor">
                <i class="fas fa-plus-circle"></i> Agregar Doctor
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-glass align-middle w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($doctores as $doctor)
                <tr>
                    <td class="fw-bold">{{ $doctor->idDoctor }}</td>
                    <td>
                        <p><strong></strong> {{ ucwords(strtolower($doctor->usuario->nombre)) }}</p>
                    </td>
                    <td>
                        <span class="badge badge-permiso" style="background:linear-gradient(92deg,#eaf6ff 70%,#b8e7fa 100%); color:#1976D2; border:1px solid #e0ebf5;">
                            <p><strong></strong> {{ ucwords(strtolower($doctor->especialidad)) }}</p>
                        </span>
                    </td>
                    <td>
                        @if($doctor->activo)
                            <span class="badge badge-activo">Activo</span>
                        @else
                            <span class="badge badge-eliminado">Inactivo</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn btn-ico edit editar"
                            data-bs-toggle="modal" data-bs-target="#modalEditarDoctor"
                            data-id="{{ $doctor->idDoctor }}"
                            data-especialidad="{{ $doctor->especialidad }}"
                            data-activo="{{ $doctor->activo ? 1 : 0 }}"
                            title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>                        
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear Doctor -->
<div class="modal fade" id="modalCrearDoctor" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/doctores/guardar" method="POST" class="modal-content glass-bg" id="formCrearDoctor">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Asignar Especialidad</h5>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <select name="idDoctor" class="form-select" required>
                    <option value="">Seleccione un usuario</option>
                    @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Especialidad</label>
                <input type="text" name="especialidad" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-secondary cancelar" type="button" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div>
</div>

<!-- Modal Editar Doctor -->
<div class="modal fade" id="modalEditarDoctor" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/doctores/editar" method="POST" class="modal-content glass-bg" id="formEditarDoctor">
        @csrf
        <input type="hidden" name="idDoctor" id="edit_idDoctor">
        <div class="modal-header">
            <h5 class="modal-title">Editar Especialidad</h5>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Especialidad</label>
                <input type="text" name="especialidad" id="edit_especialidad" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="activo" id="edit_activo" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Actualizar</button>
            <button class="btn btn-secondary cancelar" type="button" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div>
</div>

<!-- Modal Eliminar Doctor -->
<div class="modal fade" id="modalEliminarDoctor" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/doctores/eliminar" method="POST" class="modal-content glass-bg">
        @csrf
        <input type="hidden" name="idDoctor" id="delete_idDoctor">
        <div class="modal-header">
            <h5 class="modal-title">Eliminar Doctor</h5>
        </div>
        <div class="modal-body">
            <p>¿Desea eliminar este doctor?</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="submit">Eliminar</button>
            <button class="btn btn-secondary cancelar" type="button" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('.editar').on('click', function () {
            $('#edit_idDoctor').val($(this).data('id'));
            $('#edit_especialidad').val($(this).data('especialidad'));
            $('#edit_activo').val($(this).data('activo')); // <- nuevo
        });

        $('.eliminar').on('click', function () {
            $('#delete_idDoctor').val($(this).data('id'));
        });

        $('.cancelar').on('click', function () {
            $('#formCrearDoctor')[0].reset();
            $('#formEditarDoctor')[0].reset();
        });
    });
</script>

</body>
</html>
