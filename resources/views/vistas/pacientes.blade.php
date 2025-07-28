<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pacientes</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
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
            <li class="nav-item"><a class="nav-link active" href="/pacientes">Pacientes</a></li>
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

<div class="container mt-5 pt-5">
    <h1 class="text-center mb-4">Gestión de Pacientes</h1>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCrearPaciente">
            <i class="fas fa-plus-circle"></i> Agregar Paciente
        </button>
    </div>

    <table class="table table-bordered w-100 mt-4">
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
                <td>{{ $paciente->idPaciente }}</td>
                <td>{{ $paciente->usuario->nombre }}</td>
                <td>{{ $paciente->fechaNacimiento }}</td>
                <td>{{ $paciente->genero }}</td>
                <td>
                    <button class="btn btn-secondary editar"
                        data-bs-toggle="modal" data-bs-target="#modalEditarPaciente"
                        data-id="{{ $paciente->idPaciente }}"
                        data-fecha="{{ $paciente->fechaNacimiento }}"
                        data-genero="{{ $paciente->genero }}">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-danger eliminar"
                        data-bs-toggle="modal" data-bs-target="#modalEliminarPaciente"
                        data-id="{{ $paciente->idPaciente }}">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalCrearPaciente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/pacientes/guardar" method="POST" class="modal-content p-3" id="formCrearPaciente">
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

<div class="modal fade" id="modalEditarPaciente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/pacientes/editar" method="POST" class="modal-content p-3">
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

<div class="modal fade" id="modalEliminarPaciente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/pacientes/eliminar" method="POST" class="modal-content p-3">
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
</script>
</body>
</html>
