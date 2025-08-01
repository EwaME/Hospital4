<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doctores</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5 pt-5">
    <h1 class="text-center mb-4">Gestión de Doctores</h1>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCrearDoctor">
        <i class="fas fa-plus-circle"></i> Agregar Doctor
        </button>
    </div>

    <table class="table table-bordered w-100 mt-4">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Especialidad</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($doctores as $doctor)
        <tr>
            <td>{{ $doctor->idDoctor }}</td>
            <td>{{ $doctor->usuario->nombre }}</td>
            <td>{{ $doctor->especialidad }}</td>
            <td>
            <button class="btn btn-secondary editar"
                data-bs-toggle="modal" data-bs-target="#modalEditarDoctor"
                data-id="{{ $doctor->idDoctor }}"
                data-especialidad="{{ $doctor->especialidad }}">
                <i class="fas fa-edit"></i> Editar
            </button>
            <button class="btn btn-danger eliminar"
                data-bs-toggle="modal" data-bs-target="#modalEliminarDoctor"
                data-id="{{ $doctor->idDoctor }}">
                <i class="fas fa-trash"></i> Eliminar
            </button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Crear Doctor -->
<div class="modal fade" id="modalCrearDoctor" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/doctores/guardar" method="POST" class="modal-content p-3" id="formCrearDoctor">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Asignar Especialidad</h5>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Usuario</label>
                <select name="idDoctor" class="form-control" required>
                    <option value="">Seleccione un usuario</option>
                    @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Especialidad</label>
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
        <form action="/doctores/editar" method="POST" class="modal-content p-3" id="formEditarDoctor">
        @csrf
        <input type="hidden" name="idDoctor" id="edit_idDoctor">
        <div class="modal-header">
            <h5 class="modal-title">Editar Especialidad</h5>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Especialidad</label>
                <input type="text" name="especialidad" id="edit_especialidad" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Actualizar</button>
            <button class="btn btn-secondary cancelar" type="button" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEliminarDoctor" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/doctores/eliminar" method="POST" class="modal-content p-3">
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
            <li class="nav-item"><a class="nav-link" href="dashboard">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="/roles">Roles</a></li>
            <li class="nav-item"><a class="nav-link" href="/pacientes">Pacientes</a></li>
            <li class="nav-item"><a class="nav-link active" href="/doctores">Doctores</a></li>
            <li class="nav-item"><a class="nav-link" href="/usuarios">Usuarios</a></li>
            <li class="nav-item"><a class="nav-link" href="/medicamentos">Medicamentos</a></li>
            <li class="nav-item"><a class="nav-link" href="/enfermedades">Enfermedades</a></li>
            <li class="nav-item"><a class="nav-link" href="/citas">Citas</a></li>
            <li class="nav-item"><a class="nav-link" href="/consultas">Consultas</a></li>
            <li class="nav-item"><a class="nav-link" href="/consultaMedicamentos">Consulta Medicamentos</a></li>
            <li class="nav-item"><a class="nav-link" href="/historialClinico">Historial Clínico</a></li>
            <li class="nav-item"><a class="nav-link" href="/bitacoras">Bitácoras</a></li>
        </ul>
        </div>
    </div>
</nav>

</body>
</html>
