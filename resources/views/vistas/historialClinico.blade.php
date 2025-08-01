<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial Clínico</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <h1 class="text-center mb-4"> Historial Clínico</h1>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCrearHistorial">
        <i class="fas fa-plus-circle"></i> Agregar Historial
        </button>
    </div>

    <table class="table table-bordered w-100 mt-4">
        <thead>
        <tr>
            <th>Codigo Historial</th>
            <th>Nombre Paciente</th>
            <th>Resumen</th>
            <th>Fecha de Actualización</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach($historiales as $historial)
            <tr>
                <td>{{ $historial->idHistorial }}</td>
                <td>{{ $historial->nombrePaciente }}</td>
                <td>{{ $historial->resumen }}</td>
                <td>{{ \Carbon\Carbon::parse($historial->updated_at) }}</td>
                <td>
                    <button class="btn btn-secondary editar"
                        data-bs-toggle="modal" data-bs-target="#modalEditarHistorial"
                        data-id="{{ $historial->idHistorial }}"
                        data-idpaciente="{{ $historial->idPaciente }}"
                        data-resumen="{{ $historial->resumen }}"
                        data-fechaactualizacion="{{ $historial->fechaActualizacion ? $historial->fechaActualizacion->format('Y-m-d') : '' }}">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-danger eliminar"
                        data-bs-toggle="modal" data-bs-target="#modalEliminarHistorial"
                        data-id="{{ $historial->idHistorial }}"
                        data-paciente="{{ $historial->nombrePaciente }}">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalCrearHistorial" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/historialClinico/guardar" method="POST" class="modal-content p-3">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Crear Historial Clínico</h5>
        </div>
        <div class="modal-body">
            <div class="mb-3">
            <label>Paciente</label>
            <select name="idPaciente" class="form-control" required>
                @foreach($pacientes as $paciente)
                <option value="{{ $paciente->idPaciente }}">{{ $paciente->nombre }}</option>
                @endforeach
            </select>
            </div>
            <div class="mb-3">
            <label>Resumen</label>
            <textarea name="resumen" class="form-control" rows="4" required></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEditarHistorial" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/historialClinico/editar" method="POST" class="modal-content p-3">
        @csrf
        <input type="hidden" name="idHistorial" id="edit_idHistorial">
        <div class="modal-header">
            <h5 class="modal-title">Editar Historial Clínico</h5>
        </div>
        <div class="modal-body">
            <div class="mb-3">
            <label>Paciente</label>
            <select name="idPaciente" id="edit_idPaciente" class="form-control" required>
                @foreach($pacientes as $paciente)
                <option value="{{ $paciente->idPaciente }}">{{ $paciente->nombre }}</option>
                @endforeach
            </select>
            </div>
            <div class="mb-3">
            <label>Resumen</label>
            <textarea name="resumen" id="edit_resumen" class="form-control" rows="4" required></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Actualizar</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEliminarHistorial" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/historialClinico/eliminar" method="POST" class="modal-content p-3">
        @csrf
        <input type="hidden" name="idHistorial" id="delete_idHistorial">
        <div class="modal-header">
            <h5 class="modal-title">Eliminar Historial</h5>
        </div>
        <div class="modal-body">
            <p>¿Desea eliminar el historial de <strong id="delete_nombrePaciente_text"></strong>?</p>
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
        $('#edit_idHistorial').val($(this).data('id'));
        $('#edit_idPaciente').val($(this).data('idpaciente'));
        $('#edit_resumen').val($(this).data('resumen'));
        $('#edit_fechaActualizacion').val($(this).data('fechaactualizacion'));
    });

    $('.eliminar').on('click', function () {
        $('#delete_idHistorial').val($(this).data('id'));
        $('#delete_nombrePaciente_text').text($(this).data('paciente'));
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
            <li class="nav-item"><a class="nav-link" href="/doctores">Doctores</a></li>
            <li class="nav-item"><a class="nav-link" href="/usuarios">Usuarios</a></li>
            <li class="nav-item"><a class="nav-link" href="/medicamentos">Medicamentos</a></li>
            <li class="nav-item"><a class="nav-link" href="/enfermedades">Enfermedades</a></li>
            <li class="nav-item"><a class="nav-link" href="/citas">Citas</a></li>
            <li class="nav-item"><a class="nav-link" href="/consultas">Consultas</a></li>
            <li class="nav-item"><a class="nav-link" href="/consultaMedicamentos">Consulta Medicamentos</a></li>
            <li class="nav-item"><a class="nav-link active" href="/historialClinico">Historial Clínico</a></li>
            <li class="nav-item"><a class="nav-link" href="/bitacoras">Bitácoras</a></li>
        </ul>
        </div>
    </div>
</nav>

</body>
</html>
