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
</head>

<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Gestión de Usuarios</h1>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mb-3"
                data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">
            <i class="fas fa-plus-circle"></i> Agregar Usuario
        </button>
    </div>

    <table class="table table-bordered w-100 mt-4">
        <thead>
        <tr>
            <th>ID Usuario</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->usuario }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->telefono }}</td>
                <td>{{ $usuario->rol->name ?? 'Sin rol' }}</td>
                <td>
                    <button class="btn btn-secondary editar"
                            data-bs-toggle="modal" data-bs-target="#modalEditarUsuario"
                            data-id="{{ $usuario->idUsuario }}"
                            data-usuario="{{ $usuario->usuario }}"
                            data-nombre="{{ $usuario->nombre }}"
                            data-correo="{{ $usuario->correo }}"
                            data-telefono="{{ $usuario->telefono }}"
                            data-idrol="{{ $usuario->idRol }}">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-danger eliminar"
                            data-bs-toggle="modal" data-bs-target="#modalEliminarUsuario"
                            data-id="{{ $usuario->idUsuario }}"
                            data-nombre="{{ $usuario->nombre }}">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalCrearUsuario" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/usuarios/guardar" method="POST" class="modal-content p-3">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Crear Usuario</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Usuario</label>
                    <input type="text" name="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Correo</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Contraseña</label>
                    <input type="password" name="contrasena" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Rol</label>
                    <select name="idRol" class="form-select" required>
                        <option value="" disabled selected>Seleccione un rol</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->idRol }}">{{ $rol->nombreRol }}</option>
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

<div class="modal fade" id="modalEditarUsuario" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/usuarios/editar" method="POST" class="modal-content p-3">
            @csrf
            <input type="hidden" name="idUsuario" id="edit_idUsuario">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Usuario</label>
                    <input type="text" name="usuario" id="edit_usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Correo</label>
                    <input type="email" name="correo" id="edit_correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" id="edit_telefono" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Rol</label>
                    <select name="idRol" id="edit_idRol" class="form-select" required>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->idRol }}">{{ $rol->nombreRol }}</option>
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

<div class="modal fade" id="modalEliminarUsuario" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/usuarios/eliminar" method="POST" class="modal-content p-3">
            @csrf
            <input type="hidden" name="idUsuario" id="delete_idUsuario">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Usuario</h5>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar al usuario "<strong id="delete_nombreUsuario_text"></strong>"?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit">Eliminar</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('.editar').on('click', function () {
            $('#edit_idUsuario').val($(this).data('id'));
            $('#edit_usuario').val($(this).data('usuario'));
            $('#edit_nombre').val($(this).data('nombre'));
            $('#edit_correo').val($(this).data('correo'));
            $('#edit_telefono').val($(this).data('telefono'));
            $('#edit_idRol').val($(this).data('idrol'));
        });

        $('.eliminar').on('click', function () {
            $('#delete_idUsuario').val($(this).data('id'));
            $('#delete_nombreUsuario_text').text($(this).data('nombre'));
        });
    });
</script>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Gestión de Datos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="/roles">Roles</a></li>
            <li class="nav-item"><a class="nav-link" href="/pacientes">Pacientes</a></li>
            <li class="nav-item"><a class="nav-link" href="/doctores">Doctores</a></li>
            <li class="nav-item"><a class="nav-link active" href="/usuarios">Usuarios</a></li>
            <li class="nav-item"><a class="nav-link" href="/medicamentos">Medicamentos</a></li>
            <li class="nav-item"><a class="nav-link" href="/enfermedades">Enfermedades</a></li>
            <li class="nav-item"><a class="nav-link" href="/citas">Citas</a></li>
            <li class="nav-item"><a class="nav-link" href="/consultas">Consultas</a></li>
            <li class="nav-item"><a class="nav-link" href="/historialClinico">Historial Clínico</a></li>
            <li class="nav-item"><a class="nav-link" href="/bitacoras">Bitácoras</a></li>
        </ul>
        </div>
    </div>
</nav>
</body>
</html>
