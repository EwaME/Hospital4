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
</head>

<body>
<div class="container mt-5">
    <h1 class="text-center mb-4"> Gestión de Roles</h1>

    <div class="d-flex justify-content-end">  
    <button class="btn btn-primary mb-3" 
    data-bs-toggle="modal" 
    data-bs-target="#modalCrearRol">
    <i class="fas fa-plus-circle"></i> Agregar Rol</button>
    </div>

    <table class="table table-bordered w-100 mt-4">
        <thead>
            <tr>
                <th>Nombre Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $rol)
            <tr>
                <td>{{ $rol->name }}</td>
                <td>
                <button class="btn btn-secondary editar"
                    data-bs-toggle="modal" data-bs-target="#modalEditarRol"
                    data-id="{{ $rol->idRol }}"
                    data-nombrerol="{{ $rol->nombreRol }}">
                    <i class="fas fa-edit"></i> Editar</button>
                <button class="btn btn-danger eliminar"
                    data-bs-toggle="modal" data-bs-target="#modalEliminarRol"
                    data-id="{{ $rol->idRol }}"
                    data-nombrerol="{{ $rol->nombreRol }}">
                    <i class="fas fa-trash"></i> Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalCrearRol" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/roles/guardar" method="POST" class="modal-content p-3">
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
        <div class="modal-footer">
            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEditarRol">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/roles/editar" method="POST" class="modal-content p-3">
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
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Actualizar</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEliminarRol" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/roles/eliminar" method="POST" class="modal-content p-3">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('.editar').on('click', function () {
        let id = $(this).data('id');
        let nombrerol = $(this).data('nombrerol');

        $('#edit_idRol').val(id);
        $('#edit_nombreRol').val(nombrerol);

        document.getElementById('modalEditarRol').action = '/roles/editar';
    });

    $('.eliminar').on('click', function () {
        let id = $(this).data('id');
        let nombrerol = $(this).data('nombrerol');

        $('#delete_idRol').val(id);
        $('#delete_nombreRol_text').text(nombrerol);
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
            <li class="nav-item"><a class="nav-link active" href="/roles">Roles</a></li>
            <li class="nav-item"><a class="nav-link" href="/pacientes">Pacientes</a></li>
            <li class="nav-item"><a class="nav-link" href="/doctores">Doctores</a></li>
            <li class="nav-item"><a class="nav-link" href="/usuarios">Usuarios</a></li>
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
