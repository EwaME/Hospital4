<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/favicon.png">
    <title>Usuarios</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #e9f3ff 0%, #d5f3ea 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar-custom {
            min-width: 230px;
            max-width: 230px;
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            z-index: 1040;
            background: linear-gradient(125deg,#00509e 85%,#18B981 100%);
            color: #fff;
            box-shadow: 2px 0 28px #00509e13;
            padding-top: 68px;
            font-weight: 500;
        }
        @media (max-width: 991px) {
            .sidebar-custom { position: static; width: 100vw; max-width: 100vw; min-width: 0; height: auto; padding-top: 0;}
        }
        .main-content {
            margin-left: 230px;
            margin-top: 0px;
            transition: margin 0.24s;
        }
        @media (max-width: 991px) {
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
        .usuarios-header {
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
        .usuarios-header .fa-users {
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
        .error-message {
            color: #e05c3c;
            font-size: 0.98em;
            margin-top: 0.23em;
            display: none;
            font-weight: 500;
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
        @media (max-width: 991px) {
            .main-content { margin-left: 0 !important; }
            .sidebar-custom { position: static !important; width: 100vw; max-width: 100vw; min-width: 0; height: auto; padding-top: 0;}
        }
        @media (max-width: 575px) {
            .glass-bg { padding: 0.7rem 0.05rem; }
            .table-glass th, .table-glass td { font-size: .91rem;}
            .usuarios-header { font-size: 1.17rem;}
            .btn-glass, .btn-ico { font-size: 1em; padding: 0.37em 0.71em;}
            .modal-content.glass-bg { padding: 1.1rem 0.8rem 1.1rem 0.8rem !important;}
        }

        /* Badge para roles */
        .badge-rol {
            display: inline-block;
            font-weight: 700;
            font-size: 1em;
            padding: 4px 16px;
            border-radius: 13px;
            border: 1.2px solid #e0ebf5;
            letter-spacing: .01em;
            box-shadow: 0 2px 10px #00509e09;
            margin: 0 .1em;
            min-width: 80px;
            text-align: center;
        }
        .badge-rol-admin {
            background: linear-gradient(90deg,#eaf6ff 70%,#b8e7fa 100%);
            color: #1976D2;
            border-color: #b1d3f5;
        }
        .badge-rol-doctor {
            background: linear-gradient(90deg,#eafff4 70%,#c9faee 100%);
            color: #16996b;
            border-color: #a9f2da;
        }
        .badge-rol-paciente {
            background: linear-gradient(90deg,#fffee5 70%,#fff8b8 100%);
            color: #b79000;
            border-color: #f3e6a7;
        }
        .badge-rol-usuario {
            background: linear-gradient(90deg,#ffeaea 80%,#ffb8b8 100%);
            color: #b10d3a;
            border-color: #f3a7ae;
        }
    </style>
</head>

<body>
<div class="d-flex">
    @include('components.layouts.sidebar')

    <main class="main-content flex-grow-1 p-3">
        <div class="glass-bg mx-auto" style="max-width: 1050px;">
            <h1 class="usuarios-header"><i class="fas fa-users"></i> Gestión de Usuarios</h1>
            <div class="d-flex justify-content-end">
                <button class="btn btn-glass mb-3" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">
                    <i class="fas fa-plus-circle"></i> Agregar Usuario
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-glass align-middle w-100">
                    <thead>
                        <tr>
                            <th>ID Usuario</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td class="fw-bold">{{ $usuario->id }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->usuario }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>
                                @php
                                    $rolName = strtolower($usuario->rol->name);
                                    $badgeClass = match($rolName) {
                                        'admin' => 'badge-rol-admin',
                                        'doctor' => 'badge-rol-doctor',
                                        'paciente' => 'badge-rol-paciente',
                                        'usuario' => 'badge-rol-usuario',
                                        default => 'badge-rol-admin' // color por defecto si hay uno nuevo
                                    };
                                @endphp
                                <span class="badge-rol {{ $badgeClass }}">
                                    {{ $usuario->rol->name }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-ico edit editar"
                                    data-bs-toggle="modal" data-bs-target="#modalEditarUsuario"
                                    data-id="{{ $usuario->id }}"
                                    data-usuario="{{ $usuario->usuario }}"
                                    data-nombre="{{ $usuario->nombre }}"
                                    data-email="{{ $usuario->email }}"
                                    data-telefono="{{ $usuario->telefono }}"
                                    data-idrol="{{ $usuario->idRol }}"
                                    title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-ico del eliminar"
                                    data-bs-toggle="modal" data-bs-target="#modalEliminarUsuario"
                                    data-id="{{ $usuario->id }}"
                                    data-nombre="{{ $usuario->nombre }}"
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

        {{-- Modal Crear Usuario --}}
        <div class="modal fade" id="modalCrearUsuario" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form action="/usuarios/guardar" method="POST" class="modal-content glass-bg" id="formCrear">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Crear Usuario</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <input type="text" name="usuario" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombreCrear" class="form-control" required>
                            <div class="error-message" id="errorNombreCrear">Solo se permiten letras.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" id="telefonoCrear" class="form-control" required>
                            <div class="error-message" id="errorTelefonoCrear">Solo se permiten números.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="contrasena" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rol</label>
                            <select name="idRol" class="form-select" required>
                                <option value="" disabled selected>Seleccione un rol</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Guardar</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Editar Usuario --}}
        <div class="modal fade" id="modalEditarUsuario" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form action="/usuarios/editar" method="POST" class="modal-content glass-bg" id="formEditar">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Usuario</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <input type="text" name="usuario" id="edit_usuario" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                            <div class="error-message" id="errorNombreEditar">Solo se permiten letras.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo</label>
                            <input type="email" name="email" id="edit_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" id="edit_telefono" class="form-control" required>
                            <div class="error-message" id="errorTelefonoEditar">Solo se permiten números.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rol</label>
                            <select name="idRol" id="edit_idRol" class="form-select" required>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                @endforeach
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

        {{-- Modal Eliminar Usuario --}}
        <div class="modal fade" id="modalEliminarUsuario" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form action="/usuarios/eliminar" method="POST" class="modal-content glass-bg" id="formEliminar">
                    @csrf @method('DELETE')
                    <input type="hidden" name="id" id="delete_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar Usuario</h5>
                    </div>
                    <div class="modal-body">
                        <p><strong>ID del usuario:</strong> <span id="delete_id_text"></span></p>
                        <p>¿Desea eliminar al usuario "<strong id="delete_nombreUsuario_text"></strong>"?</p>
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

<script>
function soloLetras(texto) {
    return /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]*$/.test(texto);
}
function soloNumeros(texto) {
    return /^[0-9]*$/.test(texto);
}
function configurarValidacionTexto(selector, errorSelector) {
    $(selector).on('keypress', function(e) {
        var char = String.fromCharCode(e.which);
        if (e.which === 8 || e.which === 0 || e.which === 46) return true;
        if (!/[A-Za-zÁÉÍÓÚáéíóúÑñ\s]/.test(char)) {
            e.preventDefault();
            $(errorSelector).show();
            setTimeout(() => $(errorSelector).hide(), 3000);
            return false;
        }
    });
    $(selector).on('input', function() {
        let valor = $(this).val();
        let limpio = valor.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
        if (valor !== limpio) {
            $(this).val(limpio);
            $(errorSelector).show();
            setTimeout(() => $(errorSelector).hide(), 3000);
        }
    });
}
function configurarValidacionNumero(selector, errorSelector) {
    $(selector).on('keypress', function(e) {
        var char = String.fromCharCode(e.which);
        if (e.which === 8 || e.which === 0) return true;

        // Limitar a máximo 8 caracteres
        if ($(this).val().length >= 8) {
            e.preventDefault();
            $(errorSelector).show();
            setTimeout(() => $(errorSelector).hide(), 3000);
            return false;
        }

        if (!/[0-9]/.test(char)) {
            e.preventDefault();
            $(errorSelector).show();
            setTimeout(() => $(errorSelector).hide(), 3000);
            return false;
        }
    });
    $(selector).on('input', function() {
        let valor = $(this).val();
        let limpio = valor.replace(/[^0-9]/g, '');

        // Si excede 8 caracteres, corta el texto a 8
        if (limpio.length > 8) {
            limpio = limpio.substring(0, 8);
            $(errorSelector).show();
            setTimeout(() => $(errorSelector).hide(), 3000);
        }

        if (valor !== limpio) {
            $(this).val(limpio);
            $(errorSelector).show();
            setTimeout(() => $(errorSelector).hide(), 3000);
        }
    });
}
$(document).ready(function() {
    configurarValidacionTexto('#nombreCrear', '#errorNombreCrear');
    configurarValidacionNumero('#telefonoCrear', '#errorTelefonoCrear');
    configurarValidacionTexto('#edit_nombre', '#errorNombreEditar');
    configurarValidacionNumero('#edit_telefono', '#errorTelefonoEditar');
    $('.editar').on('click', function() {
        $('#edit_id').val($(this).data('id'));
        $('#edit_usuario').val($(this).data('usuario'));
        $('#edit_nombre').val($(this).data('nombre'));
        $('#edit_email').val($(this).data('email'));
        $('#edit_telefono').val($(this).data('telefono'));
        $('#edit_idRol').val($(this).data('idrol'));
    });
    $('.eliminar').on('click', function() {
        $('#delete_id').val($(this).data('id'));
        $('#delete_id_text').text($(this).data('id'));
        $('#delete_nombreUsuario_text').text($(this).data('nombre'));
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>