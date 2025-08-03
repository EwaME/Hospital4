<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/favicon.png">
    <title>Roles</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #e9f3ff 0%, #d5f3ea 100%);
            min-height: 100vh;
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
        .roles-header {
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
        .roles-header .fa-user-shield {
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
        .table-glass tr {
            transition: background 0.14s;
        }
        .table-glass tbody tr:hover {
            background: rgba(24,185,129,0.12) !important;
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

        .badge-permiso {
            background: linear-gradient(92deg,#eaf6ff 70%,#b8e7fa 100%);
            color: #1976D2;
            font-weight: 500;
            border-radius: 7px;
            font-size: .98em;
            margin-bottom: 0.18em;
            margin-right: 0.4em;
            padding: 0.4em 0.8em;
            border: 1px solid #e0ebf5;
            box-shadow: 0 1px 5px #00509e13;
            letter-spacing: 0.01em;
        }

        .form-control, .form-select, .select2-selection {
            border-radius: 0.75em !important;
            background: rgba(255,255,255,0.93) !important;
            border: 1.4px solid #c7e5f8 !important;
            box-shadow: 0 1.5px 6px #00509e11;
            font-size: 1.04em !important;
            transition: border 0.18s, box-shadow 0.22s;
        }
        .form-control:focus, .form-select:focus, .select2-selection:focus {
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
            .roles-header { font-size: 1.17rem;}
            .btn-glass, .btn-ico { font-size: 1em; padding: 0.37em 0.71em;}
            .modal-content.glass-bg { padding: 1.1rem 0.8rem 1.1rem 0.8rem !important;}
        }
    </style>
</head>
<body>
<div class="d-flex">

    @include('components.layouts.sidebar')

    <main class="flex-1 p-3 md:p-8" style="width:100%;">
        <div class="glass-bg mx-auto" style="max-width: 920px;">
            <h1 class="roles-header"> <i class="fas fa-user-shield"></i> Gestión de Roles</h1>
            <div class="d-flex justify-content-end">
                <button class="btn btn-glass mb-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCrearRol">
                    <i class="fas fa-plus-circle"></i> Agregar Rol
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-glass align-middle">
                    <thead>
                        <tr>
                            <th>Nombre Rol</th>
                            <th>Permisos</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $rol)
                        <tr>
                            <td class="fw-bold">{{ $rol->name }}</td>
                            <td>
                                @foreach($rol->permissions as $permiso)
                                    <span class="badge badge-permiso">{{ $permiso->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <button class="btn btn-ico edit editar"
                                    data-bs-toggle="modal" data-bs-target="#modalEditarRol"
                                    data-id="{{ $rol->id }}"
                                    data-nombrerol="{{ $rol->name }}"
                                    title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-ico del eliminar"
                                    data-bs-toggle="modal" data-bs-target="#modalEliminarRol"
                                    data-id="{{ $rol->id }}"
                                    data-nombre="{{ $rol->name }}"
                                    title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modals -->
        <div class="modal fade" id="modalCrearRol" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form action="/roles/guardar" method="POST" class="modal-content p-3 glass-bg">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Crear Rol</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                    <label class="form-label">Nombre del Rol</label>
                    <input type="text" name="nombreRol" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Permisos</label>
                    <select name="permisos[]" class="form-select select2" multiple required>
                        @foreach($permisos as $permiso)
                            <option value="{{ $permiso->name }}">{{ $permiso->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Guardar</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modalEditarRol">
            <div class="modal-dialog modal-dialog-centered">
                <form action="/roles/editar" method="POST" class="modal-content p-3 glass-bg">
                @csrf
                <input type="hidden" name="idRol" id="edit_idRol">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Rol</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                    <label class="form-label">Nombre del Rol</label>
                    <input type="text" name="nombreRol" id="edit_nombreRol" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Permisos</label>
                    <select name="permisos[]" id="edit_permisos" class="form-select select2" multiple required>
                        @foreach($permisos as $permiso)
                            <option value="{{ $permiso->name }}">{{ $permiso->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modalEliminarRol" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form action="/roles/eliminar" method="POST" class="modal-content p-3 glass-bg">
                @csrf
                <input type="hidden" name="idRol" id="delete_idRol">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Rol</h5>
                </div>
                <div class="modal-body">
                    <p>¿Desea eliminar el rol "<strong id="delete_nombreRol_text"></strong>"?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.editar').on('click', function () {
            let id = $(this).data('id');
            let nombrerol = $(this).data('nombrerol');
            $('#edit_idRol').val(id);
            $('#edit_nombreRol').val(nombrerol);
            $.get('/roles/permisos/' + id, function (data) {
                $('#edit_permisos').val(data).trigger('change');
            });
        });
        $('.eliminar').on('click', function () {
            const idRol = $(this).data('id');
            const nombreRol = $(this).data('nombre');
            $('#delete_idRol').val(idRol);
            $('#delete_nombreRol_text').text(nombreRol); 
        });
        $('.select2').select2({
            width: '100%',
            dropdownParent: $('#modalCrearRol')
        });
        $('#edit_permisos').select2({
            width: '100%',
            dropdownParent: $('#modalEditarRol')
        });
    });
</script>
</body>
</html>
